<navigation>
  <?php 
  
  $page['id'] = $page['id'] ?? "";
  $page['subject_id'] = $page['subject_id'] ?? "";
   
    $getSubOpt['getVisible'] = $getVisible;

    $response = db_query($getSubjects, $getSubOpt);   
    $nav_subjects = [];

    if($response["succes"]){
        $nav_subjects =  $response['data'];   
    }
    else{
        SQLError("public_navigation.php:".$response['data']);
        echo '<p>Sorry, failed to load.</br>Please try again in a minute.</p>';
        exit;   
    }
    
  ?>

  <ul class="subjects">
    <?php foreach($nav_subjects as $nav_subject) { ?>
      <li class="<?php if($page['subject_id'] == $nav_subject['id']){echo "selected";};?>">
        <a href="<?php echo url_for('index.php?subject_id='.h(u($nav_subject['id']))); ?>">
          <?php echo h($nav_subject['menu_name']); ?>
        </a>
        <?php 

            if($subject["id"] == $nav_subject['id']){
              $nav_subject['getVisible'] = $getVisible;
              $response = db_query($getPageBySubID, $nav_subject);   
              $nav_pages = [];
              
              if($response["succes"]){
                  $nav_pages =  $response['data'];   
              }
              else{
                echo $response['data'];
                  //   echo '<p>Sorry, failed to load.</br>Please try again in a minute.</p>';
                  //   exit;   
                  
              }  

        ?>
        <ul class="pages">
            <?php   
                if(gettype($nav_pages) === "array"){          

                    foreach($nav_pages as $nav_page){
 
            ?> 
            <li class="<?php if($page['id'] == $nav_page['id']){echo "selected";};?>">
                <a href="<?php echo url_for('index.php?id='.h(u($nav_page['id']))); ?>">
                <?php echo h($nav_page['menu_name']); ?>
                </a>
            </li>
            <?php   
                    };
                }; // foreach $nav_pages   
            ?>
        </ul>  
        <?php  }; // if subject_id > 0 ?>  
      </li>
    <?php } // foreach $nav_subjects ?>
  </ul>
</navigation>
