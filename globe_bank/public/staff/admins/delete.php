<?php require_once('../../../private/initialize.php'); 

  require_login();

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/admins/"));
    exit;
  };

  $admin["id"] = $_GET['id'] ?? '1'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  // Handle form values sent by new.php
if(is_post_request()){

  $admin["first_name"] = $_POST['first_name'] ?? '';
  $admin["last_name"] = $_POST['last_name'] ?? '';
  $admin["email"] = $_POST['email'] ?? '';
  $admin["username"] = $_POST['username'] ?? '';
  $admin["password"] = $_POST['password'] ?? '';
  
  $response = db_query($deleteAdmin,$admin);   

  if(!$response["succes"]){
      echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
      echo "<a href=".url_for("/staff/admins/delete.php?id={$id}").">back<a>";
      exit;
  }
  else{   
      $_SESSION['status'] = "Operation succes: admin " . $admin["username"] . " has been removed."; 
      redirect(url_for("/staff/admins/"));
  }; 
}
else{
  $response = db_query($getAdminByID,$admin);   
  
  if($response["succes"]){
    $admin =  $response['data'][0];   
  }
  else{
    // $admin =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };
};

  $pageTitle = "Delete Subject";
  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">  
  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
  <div class="admin delete">
    <h1>Delete Admin</h1>
    <p>Are you sure you want to delete this administrator?</p>
    <p class="item"><?php echo h($admin['username']); ?></p>
    <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Admin" />
      </div>
    </form>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  