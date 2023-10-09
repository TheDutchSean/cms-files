<?php 
    // get array
    $options = [];

    foreach($positions as $pos){
        if($pos["id"] == $page['subject_id']){
            $options = $pos;
            break;
        }
    }
    
    // build options
    for($i=1; $i < $options['count']+1; $i++){     
        if($i == $page['position']){
            echo "<option value={$i} selected>{$i}</option>";  
        }
        else{
            echo "<option value={$i}>{$i}</option>";
        }
    };
?>
