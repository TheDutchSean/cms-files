<?php require_once('../../../private/initialize.php'); 

  // $pages = [
  //   ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Globe Bank'],
  //   ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'History'],
  //   ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Leadership'],
  //   ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Contact Us'],
  // ];
  require_login();
  redirect(url_for('staff/index.php'));
  exit;

  // old pages stored for refrence purposes
  $response = db_query($getPages);   
  $pages = [];
  
  if($response["succes"]){
    $pages =  $response['data'];   
  }
  else{
    $pages =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  }

  $pageTitle = "Pages";
  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">
  <div class="pages listing">
    <h1>Pages</h1>
    <div class="actions">
      <a class="action" href="<?php echo url_for('staff/pages/new.php'); ?>">Create New Page</a>
      <?php echo display_status(); ?>
    </div>  
    <table class="list">
      <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Name</th>
        <th>Content</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach($pages as $page) { ?>
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($page['subject_name']); ?></td>
          <td><?php echo h($page['position']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
          <td><?php echo h($page['menu_name']); ?></td>
          <td><?php echo h($page['content']); ?></td>
          <td><a class="action" href="<?php echo url_for('staff/pages/show.php?id='.h(u($page['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('staff/pages/edit.php?id='.h(u($page['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('staff/pages/delete.php?id='.h(u($page['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>    
