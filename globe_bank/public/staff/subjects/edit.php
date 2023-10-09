<?php

require_once('../../../private/initialize.php'); 

$pageTitle = 'Edit Subject';

require_login();

if(!isset($_GET['id'])){
  redirect(url_for("/staff/subjects/"));
  exit;
}

$subject = [];
$subject["id"] = $_GET['id'] ?? '1'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';
$subject['menu_name'] = '';
$subject['position'] = 1;
$subject['visible'] = 0;

// Handle form values sent by new.php
if(is_post_request()){

  $subject['menu_name'] = $_POST['menu_name'] ?? '';
  $subject['position'] = $_POST['position'] ?? '';
  $subject['visible'] = $_POST['visible'] ?? '';

  $errors = validate_subject($subject);
  
  if(!has_errors($errors)){

    $subject['table'] = "subjects";
   
    $response = db_query($getPosition, $subject);

     if($response["succes"]){

      $currentData = $response["data"][0];

      $position = [
        "current" => $currentData['position'],
        "new" => $subject['position'],
        "id" => $subject['id'], 
        "table" => $subject['table']
      ];    

      $response = db_query($setPositions, $position);   
    
    }
    else{
      // echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
      // echo "<a href=".url_for("/staff/subjects/edit.php?id=".$subject["id"]).">back<a>";
      // exit;
    }   

    // edit new subject
    $response = db_query($updateTable, $subject);   

    if(!$response["succes"]){
      echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
      echo "<a href=".url_for("/staff/subjects/edit.php?id=".$subject["id"]).">back<a>";
      exit;
    }
    else{  
      $_SESSION['status'] = "Operation succes: subject " . $subject["menu_name"] . " has been changed."; 
      // TO DO ADD LOG FUNCTIONS (LIKE PAGES)
      redirect(url_for("/staff/subjects/show.php?id=".$subject["id"]));
    }  
  }
}
else{
  $response = db_query($getSubjectByID, $subject);   

  if($response["succes"]){
    $subject =  $response['data'][0];   
  }
  else{
    $subject =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };
}

$response = db_query($getSubjectCount);   

$count = 1;

if($response["succes"]){
  $count = $response['data'][0]["subject_count"] + 1;   
};

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject new">
    <h1>Edit Subject</h1>
    <form action="<?php echo url_for('/staff/subjects/edit.php?id='.h(u($subject["id"]))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name'])?>" /></dd>
        <?php echo error_msg($errors['menu_name'], h($subject['menu_name']))?>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php 
              for($i=1; $i < $count;$i++){     
                if($i == $subject['position']){
                  echo "<option value={$i} selected>{$i}</option>";  
                }
                else{
                  echo "<option value={$i}>{$i}</option>";
                }
              };
            ?>
          </select>
        </dd>
        <?php echo error_msg($errors['position'], h($subject['position']))?>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if($subject['visible'] == "1") { echo " checked"; } ?> />
        </dd>
        <?php echo error_msg($errors['visible'], h($subject['visible']))?>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Subject" />
      </div>
    </form>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>