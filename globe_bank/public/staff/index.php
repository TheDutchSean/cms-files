<?php require_once('../../private/initialize.php'); ?>

<?php 

  require_login();

  $pageTitle = "Staff Menu";
  include(SHARED_PATH . '/staff_header.php'); 
?>

    <section id="content">
      <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
          <li><a href="<?php echo url_for('staff/subjects'); ?>">Subjects</a></li>
          <!-- <li><a href="<?php echo url_for('staff/pages'); ?>">Pages</a></li> -->
          <li><a href="<?php echo url_for('staff/admins'); ?>">Admins</a></li>
        </ul>
      </div>
    </section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>    

