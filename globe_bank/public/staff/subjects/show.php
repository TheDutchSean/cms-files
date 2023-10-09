<?php 

  require_once('../../../private/initialize.php'); 

  require_login();

  $pageTitle = "View Subject";

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/subjects/"));
    exit;
  };
  
  $subject["id"] = $_GET['id'] ?? '1'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  $response = db_query($getSubjectByID, $subject);   
  $subject = [];

  if($response["succes"]){
    $subject =  $response['data'][0];   
  }
  else{
    $subject =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

     
  $pages = [];

  $response = db_query($getPageBySubID, $subject);

  if($response["succes"]){
    $pages =  $response['data'];   
  }
  else{
    $pages =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  }
  
  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">  
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject show">
    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
    <?php echo display_status(); ?>
    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($subject['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>
    <hr/>
    <div id="content">
      <div class="pages listing">
        <h2>Pages</h2>
        <div class="actions">
          <a class="action" href="<?php echo url_for('staff/pages/new.php?subject_id='.u(h($subject["id"]))); ?>">Create New Page</a>
          <?php echo display_status(); ?>
        </div>  
        <table class="list">
          <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Visible</th>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <?php 
          if($pages){
            foreach($pages as $page){ ?>
              <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('staff/pages/show.php?id='.h(u($page['id']))); ?>">View</a></td>
                <td><a class="action" href="<?php echo url_for('staff/pages/edit.php?id='.h(u($page['id']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for('staff/pages/delete.php?id='.h(u($page['id']))); ?>">Delete</a></td>
              </tr>
            <?php
            }
          } ?>
        </table>
      </div>
    </div>  
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  