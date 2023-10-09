<?php


    function url_for($script_path) {
        // add the leading '/' if not present
        if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }


    function u($string="") {
        return urlencode($string);
    }
    
    function raw_u($string="") {
       return rawurlencode($string);
    }
      
    function h($string="") {
        return htmlspecialchars($string);
    }

    function error_404(){
        header($_SERVER["SERVER_PROTOCOL"]. " 404 Not Found");
        exit();
    }

    function error_500(){
        header($_SERVER["SERVER_PROTOCOL"]. " 500 Internal Server Error");
        exit();
    }

    function redirect($url=""){
        header("Location:{$url}");
        exit();
    }

    function is_post_request() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    function is_get_request() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    
    function display_errors($errors=array()) {
        $output = '';
        if(!empty($errors)) {
          $output .= "<div class=\"errors\">";
          $output .= "Please fix the following errors:";
          $output .= "<ul>";
          foreach($errors as $error) {
            $output .= "<li>" . h($error) . "</li>";
          }
          $output .= "</ul>";
          $output .= "</div>";
        }
        return $output;
    }

    function display_status(){

        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
            $status = $_SESSION['status'];
            unset($_SESSION['status']);  
            if(!is_blank($status)){
                return '<p id="message"><strong>'.h($status).'</strong></p>';
            }               
        }
      
    }

    function encrypt($data='', $options=["PASSWORD"=>PASSWORD_BCRYPT,['cost'=>10]]){
        
        if(is_blank($data)){
            return '';
        }     

        return password_hash($data, null, $options);
    }


?>
