<?php $pageTitle = 'Edit Page'; ?>
<?php

require_once('../../../private/initialize.php'); 

require_login();

if(!isset($_GET['id'])){
  redirect(url_for("/staff/subjects/"));
  exit;
};

  $page["id"] = $_GET['id'] ?? '0'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';
  $page["menu_name"] = '';
  $page["subject_id"] = '';
  $page["position"] = 1;
  $page["visible"] = 0;
  $page["content"] = "";

// Handle form values sent by index.php
if(is_post_request()){

    $page["menu_name"] = $_POST['menu_name'] ?? '';
    $page["subject_id"] = $_POST['subject_id'] ?? '';
    $page["position"] = $_POST['position'] ?? '';
    $page["visible"] = $_POST['visible'] ?? '';
    $page["content"] = $_POST['content'] ?? '';

    $errors = validate_pages($page);
    
    if(!has_errors($errors)){
      
      // $keys = array_keys($page);
      // $update = ["table" => "pages"];
      // foreach($keys as $key){
      //   array_push($update, ["column" => $key,"value" => $page[$key]]);
      // }
      $page["table"] = "pages";
   
      $response = db_query($getPosition, $page);
  
       if($response["succes"]){
  
        $currentData = $response["data"][0];
  
        $position = [
          "current" => $currentData['position'],
          "new" => $page['position'],
          "id" => $page['id'], 
          "table" => $page['table'],
          "subject_id" => $page['subject_id']
        ];    
  
        $response = db_query($setPositions, $position);   
      
      }
      else{
        // echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
        // echo "<a href=".url_for("/staff/subjects/edit.php?id=".$subject["id"]).">back<a>";
        // exit;
      } 

      $response = db_query($updateTable, $page);   

      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
          echo "<a href=".url_for("/staff/pages/edit.php?id=".$page["id"]).">back<a>";
          exit;
      }
      else{    
          $_SESSION['status'] = "Operation succes: page " . $page["menu_name"] . " has been changed.";
          // TO DO add old and changed values to log
          if($config['log']['actions']){
            logAction("User:".$_SESSION['username']." has changed page ".$page["menu_name"]);
          }
          redirect(url_for("/staff/pages/show.php?id=".$page["id"]));
      }
    }

}
else{
  $response = db_query($getPageByID, $page);   

  if($response["succes"]){
    $page =  $response['data'][0];   
  }
  else{
    $page =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

}

include(SHARED_PATH . '/get_page_data.php'); 

?>



<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">
<a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id='.u(h($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>
  <div class="pages new">
    <h1>Edit pages</h1>
    <form action="<?php echo url_for('/staff/pages/edit.php?id='.h(u($page["id"]))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page["menu_name"])?>" /></dd>
        <?php echo error_msg($errors['menu_name'], h($page['menu_name']))?>
      </dl>
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id" id="subject">
            <?php include(SHARED_PATH . '/subject_options.php'); ?>
          </select>
        </dd>
        <?php echo error_msg($errors['subject_id'], h($page['subject_id']))?>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position" id="position">
            <?php include(SHARED_PATH . '/position_options.php'); ?>          
          </select>
        </dd>
        <?php echo error_msg($errors['position'], h($page['position']))?>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if($page["visible"] == "1") { echo " checked"; } ?> />
        </dd>
        <?php echo error_msg($errors['visible'], h($page['visible']))?>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
        </dd>
        <?php echo error_msg($errors['content'], "")?>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
  </div>
</section>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>


