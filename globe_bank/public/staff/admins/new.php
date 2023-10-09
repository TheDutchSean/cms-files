<?php require_once('../../../private/initialize.php');

  require_login();

  if(is_post_request()){

    $admin["first_name"] = $_POST['first_name'] ?? '';
    $admin["last_name"] = $_POST['last_name'] ?? '';
    $admin["email"] = $_POST['email'] ?? '';
    $admin["username"] = $_POST['username'] ?? '';
    $admin["password"] = $_POST['password'] ?? '';
    $admin["confirm_password"] = $_POST['confirm_password'] ?? '';

    $errors = validate_admin($admin);

    if(!has_errors($errors)){
      $admin["password"] = encrypt($admin["password"]);
      $response = db_query($addAdmin, $admin);   

      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
          echo "<a href=".url_for("/staff/admins/new.php").">back<a>";
          exit;
      }
      else{    
          $_SESSION['status'] = "Operation succes: admin " . $admin["username"] . " has been created."; 
          $newId = $response["data"];
          redirect(url_for("/staff/admins/show.php?id={$newId}"));
      }

    } 
  }

?>

<?php $pageTitle = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create Admin</h1>
    <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
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
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>

</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>