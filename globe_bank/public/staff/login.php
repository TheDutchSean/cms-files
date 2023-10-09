<?php
require_once('../../private/initialize.php');

$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if(is_blank($username)){
    $errors['username'] = "Username cannot be blank.";
  };

  if(is_blank($password)){
    $errors['password'] = "Password cannot be blank.";
  };

  if(!has_errors($errors)){

    $response = db_query($getAdminByUserName, ["username"=>$username]);

    if(!$response["succes"]){
      echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
      // echo "<a href=".url_for("/staff/admins/new.php").">back<a>";
      exit;
    }
    else{  
      $admin = $response['data'][0];
      if($admin){
        if(password_verify($password, $admin['password'])){
          log_in_admin($admin);
          redirect(url_for('/staff/index.php'));
        }
        else{
          $errors['submit'] = "Login was unsuccesful.";
        }
      }
      else{
        $errors['submit'] = "Login was unsuccesful.";
      }
    }  
  } 
}

?>

<?php $pageTitle = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    <?php echo error_msg($errors['username'])?>
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <?php echo error_msg($errors['password'])?>
    <input type="submit" name="submit" value="Submit"  />
    <?php echo error_msg($errors['submit'])?>
  </form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
