<?php require_once('../../private/initialize.php'); 

  require_login();
  
  $pageTitle = "Server Admins";
  include(SHARED_PATH . '/staff_header.php'); 
?>

    <section id="content">
      <div class="admin listing">
      <h1>Server Admin</h1>

        <div class="actions">
        <a class="action" href="<?php echo url_for('admin/log.php'); ?>">Logs</a>
        </div>
      </div>
    </section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>    