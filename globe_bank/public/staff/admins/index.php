<?php require_once('../../../private/initialize.php'); 

  require_login();
  
  $response = db_query($getAdmins);    
  
  if($response["succes"]){
    $admins =  $response['data'];   
  }
  else{
    // $admins =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  }
 
  $pageTitle = "Admins";
  include(SHARED_PATH . '/staff_header.php'); 
?>

    <section id="content">
      <div class="admin listing">
        <h1>Admins</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('staff/admins/new.php'); ?>">Create New Admin</a>
        </div>
        <?php 
          if(gettype($admins) !== "array"){
            echo "no admin data found";
            exit;
          };
          echo display_status(); 
        ?>
        <table class="list">
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Username</th>
            <!-- <th>Password Set</th> -->
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>

          <?php foreach($admins as $admin) {?>
            
            <tr>
              <td><?php echo h($admin['id']);?></td>
              <td><?php echo h($admin['first_name']);?></td>
              <td><?php echo h($admin['last_name'])?></td>
              <td><?php echo h($admin['email']); ?></td>
              <td><?php echo h($admin['username']); ?></td>
              <!-- <td><?php echo !is_blank($admin['password']) ? 'true' : 'false'; ?></td> -->
              <td><a class="action" href="<?php echo url_for('staff/admins/show.php?id='.h(u($admin['id']))); ?>">View</a></td>
              <td><a class="action" href="<?php echo url_for('staff/admins/edit.php?id='.h(u($admin['id']))); ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('staff/admins/delete.php?id='.h(u($admin['id']))); ?>">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>    
