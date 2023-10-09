<?php require_once('../../../private/initialize.php'); 

  require_login();

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/admins/"));
    exit;
  };
  
  $admin["id"] = $_GET['id'] ?? '1'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  $response = db_query($getAdminByID, $admin);   
  $admin = [];
  
  if($response["succes"]){
    $admin =  $response['data'][0];   
  }
  else{
    // $admin =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

  $pageTitle = "View Subject";
  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">  
  <a class="back-link" href="<?php echo url_for('/staff/admins/'); ?>">&laquo; Back to List</a>
  <div class="subject show">
    <h1>Admin: <?php echo h($admin['username']); ?></h1>
    <?php echo display_status(); ?>
    <div class="attributes">
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($admin['username']); ?></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($admin['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($admin['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin['email']); ?></dd>
      </dl>
      <!-- <dl>
        <dt>Password</dt>
        <dd><?php echo h($admin['password']); ?></dd>
      </dl> -->
    </div>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  