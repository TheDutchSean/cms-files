<?php require_once('../../../private/initialize.php');
 
  require_login();
 
  $pageTitle = 'Create Subject';

  $subject["menu_name"] = '';
  $subject["position"] = '1';
  $subject["visible"] = '0';

  if(is_post_request()){

    $subject["menu_name"] = $_POST['menu_name'] ?? '';
    $subject["position"] = $_POST['position'] ?? '';
    $subject["visible"] = $_POST['visible'] ?? '';

    $errors = validate_subject($subject);

    if(!has_errors($errors)){

      $subject['table'] = "subjects";
    
      $position = [
        "current" => 0,
        "new" => $subject['position'],
        "id" => $subject['id'], 
        "table" => $subject['table']
      ];    

      $response = db_query($setPositions, $position);   
      
      // add new subject
      $response = db_query($addSubject, $subject);   

      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
          echo "<a href=".url_for("/staff/subjects/new.php").">back<a>";
          exit;
      }
      else{    
        $_SESSION['status'] = "Operation succes: subject " . $subject["menu_name"] . " has been added."; 
          $newId = $response["data"];
          redirect(url_for("/staff/subjects/show.php?id={$newId}"));
      }

    } 
  }

  $response = db_query($getSubjectCount);   

  $count = 1;

  if($response["succes"]){
    $count = $response['data'][0]["subject_count"] + 2;   
  };  

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>
    <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($subject["menu_name"]);?>" /></dd>
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
        <input type="submit" value="Create Subject" />
      </div>
    </form>

  </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>