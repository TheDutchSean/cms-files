<?php 

    function validate_subject($subject) {

        global $errors;
        
        // menu_name
        if(is_blank($subject['menu_name'])) {
            $errors['menu_name'] = "Name cannot be blank.";
        }
        else if(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors['menu_name'] = "Name must be between 2 and 255 characters.";
        }
        else{

            $subject['id'] = $subject['id'] ?? '0';
            $validate_name = validate_subject_name($subject);
            
            if(!$validate_name["valid"]){
                $errors['menu_name'] = $validate_name["error"];
            };
        }

    
        // position
        // Make sure we are working with an integer
        $postion_int = (int) $subject['position'];
        if($postion_int <= 0) {
            $errors['position'] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors['position'] = "Position must be less than 999.";
        }
    
        // visible
        // Make sure we are working with a string
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors['visible'] = "Visible must be true or false.";
        }

        return $errors;

    }

    function validate_subject_name($subject){
        global $findSubjectName;

        $subject['id'] = $subject['id'] ?? '0';
        $response = db_query($findSubjectName, $subject);

        if(!$response["succes"]){
            return ["valid" => false, "error" => "<p>mysqli_error:".$response["data"]."</p></br>"];
        }
        else{ 
            if(empty($response["data"])){
                return ["valid" => true, "error" => ""];  
            } 
            return ["valid" => false, "error" => "Menu name ".$subject["menu_name"]." already exists."]; 
        } 
    
    }

    function validate_pages($pages) {

        global $errors;
        
        // menu_name
        if(is_blank($pages['menu_name'])) {
            $errors['menu_name'] = "Page name cannot be blank.";
        }
        else if(!has_length($pages['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors['menu_name'] = "Page name must be between 2 and 255 characters.";
        }
        else{
            $pages['id'] = $pages['id'] ?? '0';
            $validate_name = validate_page_name($pages);
            
            if(!$validate_name["valid"]){
                $errors['menu_name'] = $validate_name["error"];
            };
        }

        // subject id
        // Make sure we are working with an integer
        $subject_id_int = (int) $pages['subject_id'];
        if($subject_id_int <= 0) {
            $errors['subject_id'] = "Subject must be greater than zero.";
        }
        if($subject_id_int > 9999999) {
            $errors['subject_id'] = "Subject must be less than 999.";
        }
    
        // position
        // Make sure we are working with an integer
        $postion_int = (int) $pages['position'];
        if($postion_int <= 0) {
            $errors['position'] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
            $errors['position'] = "Position must be less than 999.";
        }
    
        // visible
        // Make sure we are working with a string
        $visible_str = (string) $pages['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors['visible'] = "Visible must be true or false.";
        }

        // content
        if(is_blank($pages['content'])) {
            $errors['content'] = "Content cannot be blank.";
        }


        return $errors;

    }

    function validate_page_name($page){

        global $findPageName;

        $page['id'] = $page['id'] ?? '0';
        $response = db_query($findPageName, $page);

        if(!$response["succes"]){
            return ["valid" => false, "error" => "<p>mysqli_error:".$response["data"]."</p></br>"];
        }
        else{ 
            if(empty($response["data"])){
                return ["valid" => true, "error" => ""];  
            } 
            return ["valid" => false, "error" => "Menu name ".$page["menu_name"]." already exists."]; 
        } 
    
    }

    function validate_admin($admin, $options=["password_required" => true]) {

        global $errors;
        
        $admin['id'] = $admin['id'] ?? '0';
        $options["password_required"] = $options["password_required"] ?? true;

        // first name
        if(is_blank($admin['first_name'])) {
            $errors['first_name'] = "First Name cannot be blank.";
        }
        else if(!has_length($admin['first_name'], ['min' => 2, 'max' => 255])) {
            $errors['first_name'] = "First Name must be between 2 and 255 characters.";
        }

        // last name
        if(is_blank($admin['last_name'])) {
            $errors['last_name'] = "Last Name cannot be blank.";
        }
        else if(!has_length($admin['first_name'], ['min' => 2, 'max' => 255])) {
            $errors['last_name'] = "Last Name must be between 2 and 255 characters.";
        }
 
        // email
        if(is_blank($admin['email'])) {
            $errors['email'] = "Email cannot be blank.";
        }
        else if(!has_length($admin['email'], ['min' => 2, 'max' => 255])) {
            $errors['email'] = "Email must be between 2 and 255 characters.";
        }
        else if(!has_valid_email_format($admin['email'])){
            $errors['email'] = "Invalid email.";
        }
        else{
            $validate_email = validate_admin_email($admin);
            
            if(!$validate_email["valid"]){
                $errors['email'] = $validate_email["error"];
            };
        }

        // username
        if(is_blank($admin['username'])) {
            $errors['username'] = "Username cannot be blank.";
        }
        else if(!has_length($admin['username'], ['min' => 2, 'max' => 255])) {
            $errors['username'] = "Username must be between 2 and 255 characters.";
        }
        else{
            $validate_username = validate_admin_username($admin);
            
            if(!$validate_username["valid"]){
                $errors['username'] = $validate_username["error"];
            };
        }

        if(!$options["password_required"]){
            return $errors; 
        }

        // password
        if(is_blank($admin['password'])) {
            $errors['password'] = "Password cannot be blank.";
        }
        else if(!has_length($admin['password'], ['min' => 12, 'max' => 255])) {
            $errors['password'] = "Password must be between 12 and 255 characters.";
        }
        elseif (!has_length($admin['password'], array('min' => 12))) {
            $errors['password'] = "Password must contain 12 or more characters";
        } 
        elseif (!preg_match('/[A-Z]/', $admin['password'])) {
            $errors['password'] = "Password must contain at least 1 uppercase letter";
        } 
        elseif (!preg_match('/[a-z]/', $admin['password'])) {
            $errors['password'] = "Password must contain at least 1 lowercase letter";
        } 
        elseif (!preg_match('/[0-9]/', $admin['password'])) {
            $errors['password'] = "Password must contain at least 1 number";
        } 
        elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
            $errors['password'] = "Password must contain at least 1 symbol";
        }
        // Confirmation password
        else if(is_blank($admin['confirm_password'])) {
            $errors['confirm_password'] = "Confirmation password cannot be blank.";
        }
        else if(!has_length($admin['confirm_password'], ['min' => 12, 'max' => 255])) {
            $errors['confirm_password'] = "Confirmation must be between 12 and 255 characters.";
        } 
        else if($admin['confirm_password'] !== $admin['password']){
            $errors['confirm_password'] = "Password not equal to confirm.";
        }
          
        return $errors;

    }

    function validate_admin_username($admin){

        global $findAdminUserName;

        $admin['id'] = $admin['id'] ?? '0';
        $response = db_query($findAdminUserName, $admin);

        if(!$response["succes"]){
            return ["valid" => false, "error" => "<p>mysqli_error:".$response["data"]."</p></br>"];
        }
        else{ 
            if(empty($response["data"])){
                return ["valid" => true, "error" => ""];  
            } 
            return ["valid" => false, "error" => "Menu name ".$admin["username"]." already exists."]; 
        } 
    
    }

    function validate_admin_email($admin){

        global $findAdminEmail ;

        $admin['id'] = $admin['id'] ?? '0';
        $response = db_query($findAdminEmail , $admin);

        if(!$response["succes"]){
            return ["valid" => false, "error" => "<p>mysqli_error:".$response["data"]."</p></br>"];
        }
        else{ 
            if(empty($response["data"])){
                return ["valid" => true, "error" => ""];  
            } 
            return ["valid" => false, "error" => "Menu name ".$admin["menu_name"]." already exists."]; 
        } 
    
    }
  
    function has_errors($errors){

        foreach($errors as $error){
            if(!is_blank($error)){
                return true;
            }
        }

        return false;
    }

    function error_msg($error, $value=""){
         
        if(!is_blank($error)){
            // if(is_blank($value)){
            //     $msg = "<span class='errors'>*{$error}</span>";
            // }
            // else{
            //     $msg = "<span class='errors'>*{$error} is {$value}</span>";
            // }
            // return $msg;
            return "<span class='errors'>*".h($error)."</span>";
        }
        return;
    }




?>