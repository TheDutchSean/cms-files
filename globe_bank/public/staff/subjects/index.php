<?php require_once('../../../private/initialize.php'); 

  // $subjects = [
  //   ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
  //   ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
  //   ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
  //   ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
  // ];
  require_login();  

  $pageTitle = "Subjects";
  
  $response = db_query($getSubjects);   
  $subjects = [];
  
  if($response["succes"]){
    $subjects =  $response['data'];   
  }
  else{
    $subjects =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  }

  include(SHARED_PATH . '/staff_header.php'); 
?>

    <section id="content">
      <div class="subjects listing">
        <h1>Subjects</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('staff/subjects/new.php'); ?>">Create New Subject</a>
        </div>
        <?php echo display_status(); ?>
        <table class="list">
          <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Visible</th>
            <th>Name</th>
            <th>Pages</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>

          <?php foreach($subjects as $subject) { ?>
            <tr>
              <td><?php echo h($subject['id']); ?></td>
              <td><?php echo h($subject['position']); ?></td>
              <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
              <td><?php echo h($subject['menu_name']); ?></td>
              <td><?php 
                $response = db_query($getPageCount, $subject);

                if($response['succes']){
                  echo h($response['data'][0]["page_count"]);
                }
                else{
                  echo "?";
                }
              ?>
              </td>
              <td><a class="action" href="<?php echo url_for('staff/subjects/show.php?id='.h(u($subject['id']))); ?>">View</a></td>
              <td><a class="action" href="<?php echo url_for('staff/subjects/edit.php?id='.h(u($subject['id']))); ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('staff/subjects/delete.php?id='.h(u($subject['id']))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>    
