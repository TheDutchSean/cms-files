<?php

require_once('../../../private/initialize.php'); 

require_login();

if(!isset($_GET['id'])){
  redirect(url_for("/staff/admins/"));
  exit;
}

$admin["id"] = $_GET['id'] ?? '0';

// Handle form values sent by new.php
if(is_post_request()){

    $admin["first_name"] = $_POST['first_name'] ?? '';
    $admin["last_name"] = $_POST['last_name'] ?? '';
    $admin["email"] = $_POST['email'] ?? '';
    $admin["username"] = $_POST['username'] ?? '';
    $admin["password"] = $_POST['password'] ?? '';
    $admin["confirm_password"] = $_POST['confirm_password'] ?? '';

    $errors = validate_admin($admin, $options=["password_required" => !is_blank($admin["password"])]);

    if(!has_errors($errors)){
      // format the data to containt the right fields
      if(!is_blank($admin["password"])){
        $admin["hashed_password"] = encrypt($admin["password"]);
      }

      if(array_key_exists("password", $admin)){
        array_splice($admin, array_search("password", array_keys($admin)) ,1);
      }

      if(array_key_exists("confirm_password", $admin)){
        array_splice($admin, array_search("confirm_password", array_keys($admin)) ,1);
      } 
      
      $admin['table'] = "admins";

      $response = db_query($updateTable, $admin);   

      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
          echo "<a href=".url_for("/staff/admins/edit.php?id=".$admin["id"]).">back<a>";
          exit;
      }
      else{    
          $_SESSION['status'] = "Operation succes: admin " . $admin["username"] . " has been changed."; 
          redirect(url_for("/staff/admins/show.php?id=".$admin["id"]));
      }
    }
}
else{
  $response = db_query($getAdminByID, $admin);   

  if($response["succes"]){
    $admin =  $response['data'][0];   

  }
  else{
    // $admin =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

  $admin['password'] =  "";
  $admin['confirm_password'] = "";   

}

?>

<?php $pageTitle = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">
  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
  <div class="admin edit">
    <h1>Edit Admin</h1>
    <form action="<?php echo url_for('/staff/admins/edit.php?id='.h(u($admin["id"]))); ?>" method="post">
    <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($admin["first_name"]);?>" /></dd>
        <?php echo error_msg($errors['first_name'], h($admin['first_name']))?>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($admin["last_name"]);?>" /></dd>
        <?php echo error_msg($errors['last_name'], h($admin['last_name']))?>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($admin["email"]);?>" /></dd>
        <?php echo error_msg($errors['email'], h($admin['email']))?>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($admin["username"]);?>" /></dd>
        <?php echo error_msg($errors['username'], h($admin['username']))?>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="<?php echo h($admin["password"]);?>" /></dd>
        <?php echo error_msg($errors['password'], h($admin['password']))?>
      </dl>
      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="<?php echo h($admin["confirm_password"]);?>" /></dd>
        <?php echo error_msg($errors['confirm_password'], h($admin['confirm_password']))?>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>