<?php 
    foreach($subjects as $subject){
        if($page['subject_id'] == $subject['id']){
            echo "<option value=".$subject['id']." selected>".h($subject['menu_name'])."</option>";
        }
        else{
            echo "<option value=".$subject['id'].">".h($subject['menu_name'])."</option>";
        }
    };
?>
