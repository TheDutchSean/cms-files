<?php require_once('../../../private/initialize.php'); 

  require_login();

  $pageTitle = "View Subject";

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/subjects/"));
    exit;
  };

  $subject = [];

  $subject["id"] = $_GET['id'] ?? '1'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  $response = db_query($getSubjectByID, $subject);   
  
  if($response["succes"]){
    $subject =  $response['data'][0];   

    if(is_post_request()){

      $subject['table'] = "subjects";
  
      $position = [
        "current" => $subject['position'],
        "new" => 0,
        "id" => $subject['id'], 
        "table" => $subject['table']
      ];    
      
      $response = db_query($setPositions, $position);   
      
      // delete subject
      $response = db_query($deleteSubject,$subject);   
  
      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
          echo "<a href=".url_for("/staff/subjects/delete.php?id={$id}").">back<a>";
          exit;
      }
      else{   
          $_SESSION['status'] = "Operation succes: subject " . $subject["menu_name"] . " has been removed."; 
          redirect(url_for("/staff/subjects/"));
      }; 
    }; 
  }
  else{
    $subject =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">  
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?php echo h($subject['menu_name']); ?></p>
    <form action="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  