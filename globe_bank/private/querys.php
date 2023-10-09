<?php 

    $getSubjects = function($subject = []){

        $getVisible = $subject['getVisible'] ?? false;
        $order ='ASC';
        
        if(isset($subject['order']) && str_starts_with(strtoupper($subject['order']), "DESC")){
            $order = 'DESC';
        };

        if($getVisible){
            return "SELECT * FROM subjects WHERE visible=true ORDER BY position ".$order.";";
        }

        return "SELECT * FROM subjects ORDER BY position ".$order.";";
    };

    $getSubjectByID = function($subject){
        return "SELECT * FROM subjects WHERE id='".$subject['id']."';";
    };

    $getSubjectCount = function (){
        return "SELECT COUNT(id) AS subject_count FROM subjects;";
    };

    $addSubject = function ($subject){
        return "INSERT INTO subjects (menu_name, position, visible) VALUES ('".$subject["menu_name"]."','".$subject["position"]."','".$subject["visible"]."');";
    };

    $deleteSubject = function ($subject){
        return "DELETE FROM subjects WHERE id='".$subject['id']."' LIMIT 1;";
    };

    $findSubjectName = function ($subject){
        $id = $subject['id'] ?? '0';
        return "SELECT * FROM subjects WHERE menu_name='".$subject["menu_name"]."' && id!='".$id."';";
    };

    $updateTable = function ($updates){

        $id = $updates['id'] ?? '0';

        $keys = array_keys($updates);
// TO DO CHECK KEYS ON EXSITANCE
        // if(array_key_exists('table', $keys)){
            array_splice($keys, array_search("table", $keys) ,1);
        // };

        // if(array_key_exists('id', $keys)){
            array_splice($keys, array_search("id", $keys) ,1);
        // }        

        $changes = "";
        $nKeys = count($keys);

        for($i =0;$i < $nKeys; $i++){

            if($i == $nKeys - 1){
                $changes .= $keys[$i]."='".$updates[$keys[$i]]."'";
            }
            else{
                $changes .= $keys[$i]."='".$updates[$keys[$i]]."',";
            }
        }

        return "UPDATE ".$updates['table']." SET ".$changes." WHERE id='".$id."' LIMIT 1;";
    };

    $getPages = function ($pageOpt = []){

        $getVisible = $pageOpt['getVisible'] ?? false;
        $order ='ASC';
        
        if(isset($pageOpt['order']) && str_starts_with(strtoupper($pageOpt['order']), "DESC")){
            $order = 'DESC';
        };

        if($getVisible){
            return "SELECT pages.*, subjects.menu_name AS subject_name FROM pages JOIN subjects ON pages.subject_id=subjects.id WHERE pages.visible=true ORDER BY pages.subject_id ".$order.", pages.position ASC;";
        }


        return "SELECT pages.*, subjects.menu_name AS subject_name FROM pages JOIN subjects ON pages.subject_id=subjects.id ORDER BY pages.subject_id ".$order.", pages.position ASC;";
    }; 

    $getPageByID = function ($page){

        $getVisible = $page['getVisible'] ?? false;
        $order ='ASC';

        if(isset($page['order']) && str_starts_with(strtoupper($page['order']), "DESC")){
            $order = 'DESC';
        };

        $qry = "SELECT pages.*, subjects.menu_name AS subject_name ";
        $qry .= "FROM pages ";
        
        if($getVisible){
            $qry .= "JOIN subjects ON pages.subject_id=subjects.id AND subjects.visible=true ";
            $qry .= "WHERE pages.id='".$page["id"]."' AND pages.visible=true ";
        }
        else{
            $qry .= "JOIN subjects ON pages.subject_id=subjects.id ";
            $qry .= "WHERE pages.id='".$page["id"]."' ";
        }
        $qry .= "ORDER BY pages.id {$order};";
        return $qry;
    };

    $getPageBySubID = function ($subject){

        $getVisible = $subject['getVisible'] ?? false;
        $order ='ASC';
        
        if(isset($pageOpt['order']) && str_starts_with(strtoupper($pageOpt['order']), "DESC")){
            $order = 'DESC';
        };

        $qry = "SELECT pages.*, subjects.menu_name AS subject_name ";
        $qry .= "FROM pages ";
        if($getVisible){
            $qry .= "JOIN subjects ON pages.subject_id=subjects.id AND subjects.visible = true ";
            $qry .= "WHERE pages.subject_id='".$subject["id"]."' AND pages.visible=true ";
        }
        else{
            $qry .= "JOIN subjects ON pages.subject_id=subjects.id ";
            $qry .= "WHERE pages.subject_id='".$subject["id"]."' ";
        }

        $qry .= "ORDER BY pages.position {$order};";

        return $qry;
    };

    $getPageCount = function ($subject){
        return "SELECT COUNT(id) AS page_count FROM pages WHERE subject_id='".$subject["id"]."';";
    };

    $addPages = function ($page){
        return "INSERT INTO pages (menu_name, subject_id, position, visible, content) VALUES ('".$page["menu_name"]."','".$page["subject_id"]."','".$page["position"]."','".$page["visible"]."','".$page["content"]."');";
    };

    $deletePage = function ($page){
        return "DELETE FROM pages WHERE id='".$page["id"]."' LIMIT 1;";
    };

    $findPageName = function ($page){
        $id = $page['id'] ?? '0';
        return "SELECT * FROM pages WHERE menu_name='".$page["menu_name"]."' && subject_id='".$page["subject_id"]."' && id !='".$id."';";
    };

    // admin querys
    $addAdmin = function ($admin){

        $qry = "INSERT INTO admins";
        $qry .= " ";
        $qry .= "(first_name, last_name, email, username, hashed_password)";
        $qry .= " VALUES(";
        $qry .= "'".$admin["first_name"]."',";
        $qry .= "'".$admin["last_name"]."',";
        $qry .= "'".$admin["email"]."',";
        $qry .= "'".$admin["username"]."',";
        $qry .= "'".$admin["password"]."');";

        return $qry;
    };

    $getAdmins = function ($adminOpt = []){

        $order ='ASC';
        
        if(isset($adminOpt['order']) && str_starts_with(strtoupper($adminOpt['order']), "DESC")){
            $order = 'DESC';
        };
        //id, first_name, last_name, email, username
        return "SELECT *, hashed_password as password FROM admins ORDER BY last_name ".$order.", first_name ASC;";

    }; 

    $getAdminByID = function ($admin){

        if(is_blank($admin["id"])){
            return "SELECT * FROM admins WHERE id='0';"; 
        }

        return "SELECT *, hashed_password as password FROM admins WHERE id='".$admin["id"]."';";
    };

    $getAdminByUserName = function ($admin){
        $username = $admin['username'] ?? ' ';
        return "SELECT *, hashed_password as password FROM admins WHERE username='".$username."';";
    };

    $deleteAdmin = function ($admin){

        if(is_blank($admin["id"])){
            return "SELECT * FROM admins WHERE id='0';"; 
        }

        return "DELETE FROM admins WHERE id='".$admin['id']."' LIMIT 1;";
    };

    $findAdminUserName = function ($admin){
        $id = $admin['id'] ?? '0';
        return "SELECT *, hashed_password as password FROM admins WHERE username='".$admin["username"]."' && id !='".$id."';";
    };

    $findAdminEmail = function ($admin){
        $id = $admin['id'] ?? '0';
        return "SELECT *, hashed_password as password FROM admins WHERE email='".$admin["email"]."' && id !='".$id."';";
    };

    $getPositionsOLD = function ($position){

        $pos = $position["value"] ?? "0";

        if(!isset($position["table"])){
            return; 
        }
        else if($position["table"] == "pages"){
            $subject_id = $position["value"] ?? "0";
            return "SELECT id, position FROM pages WHERE position => '".$pos."', && subject_id='".$subject_id."' ORDER BY position ASC, id ASC;";
        };

        return "SELECT id, position FROM ".$position['table']." WHERE position >= '".$pos."' ORDER BY position ASC, id ASC;"; 

        // $operator = '>=';

        // if(isset($position["action"]) && strtoupper($position["action"]) == "DELETE"){

        // }       
 
    };

    $getPosition = function ($item){

        $id = $item["id"] ?? "0";

        if(!isset($item["table"])){
            return; 
        }

        return "SELECT * FROM ".$item["table"]." WHERE id='".$id."';"; 

        // $operator = '>=';

        // if(isset($position["action"]) && strtoupper($position["action"]) == "DELETE"){

        // }       
 
    };

    $setPositions = function ($item){

        $currentPos = $item["current"] ?? "0";
        $newPos = $item["new"] ?? "0";
        $id = $item["id"] ?? "0";
        $subject_id = $item["subject_id"] ?? "0";

        if($currentPos == $newPos){return;};

        $qry = "UPDATE ";

        if(!isset($item["table"])){
            return; 
        }
        else if($item["table"] == "pages"){       
            $qry .= "pages ";
        }else{
            $qry .= $item["table"]." ";
        }

        $qry .= "SET position = position ";

        // new item
        if($currentPos == 0){
            $qry .= "+ 1 WHERE position >= '".$newPos."' AND id != '".$id."' ";
        }
        // delete item
        else if($newPos == 0){
            $qry .= "- 1 WHERE position > '".$currentPos."' AND id != '".$id."' ";
        }
        else if($currentPos < $newPos){
            $qry .= "- 1 WHERE position > '".$currentPos."' AND position <= '".$newPos."' AND id != '".$id."' ";
        }
        else if($currentPos > $newPos){
            $qry .= "+ 1 WHERE position >= '".$newPos."' AND position < '".$currentPos."' AND id != '".$id."' ";
        }

        if($item["table"] == "pages"){
            $qry .= "AND subject_id = '".$subject_id."';";
        }
        else{
            $qry .= ";";
        }

        return $qry;   
    };

    function sqlValue($value){
        return "'{$value}'";
    }

?>