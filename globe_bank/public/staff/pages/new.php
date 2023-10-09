<?php require_once('../../../private/initialize.php');
  $pageTitle = 'Create Page';

  require_login();

  if(!isset($_GET['subject_id']) && !isset($_POST['subject_id'])){
    redirect(url_for("/staff/subjects/"));
    exit;
  }; 

  $menu_name = '';
  $position = 1;
  $visible = 0;

  $page['menu_name'] = "";
  $page["subject_id"] = $_GET['subject_id'] ?? '0';
  $page['position'] = "";
  $page['visible'] = "";
  $page['content'] = "";

  if(is_post_request()){
    
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $errors = validate_pages($page);

    if(!has_errors($errors)){

      $page['table'] = "pages";
    
      $position = [
        "current" => 0,
        "new" => $page['position'],
        "id" => $page['id'], 
        "table" => $page['table'],
        "subject_id" => $page['subject_id']
      ];    

      $response = db_query($setPositions, $position);   

      // add a page
      $response = db_query($addPages, $page);
    
      if(!$response["succes"]){
          echo "<p>mysqli_error:".$response["data"][0]."</p></br>"; 
          echo "<a href=".url_for("/staff/pages/new.php").">back<a>";
          exit;
      }
      else{    
          $_SESSION['status'] = "Operation succes: page " . $page["menu_name"] . " has been added.";
          $newId = $response["data"];
          if($config['log']['actions']){
            logAction("User:".$_SESSION['username']." has added page ".$page["menu_name"]);
          }  
          redirect(url_for("/staff/pages/show.php?id={$newId}"));
      }  
   
    }
  }

  include(SHARED_PATH . '/get_page_data.php');

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<section id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id='.u(h($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>
  <div class="page new">
    <h1>Create Page</h1>
    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Subject</dt>
          <dd>
            <select name="subject_id" id="subject">
              <?php include(SHARED_PATH . '/subject_options.php'); ?>
            </select>
          </dd>
          <?php echo error_msg($errors['subject_id'], h($page['subject_id']))?>
        </dl>  
      <dl>
      <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']);?>" /></dd>
        <?php echo error_msg($errors['menu_name'], h($page['menu_name']))?>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position" id="position">
            <?php include(SHARED_PATH . '/position_options.php'); ?> 
          </select>
        </dd>
        <?php echo error_msg($errors['position'], h($page['position']))?>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == "1") { echo " checked"; } ?> />
        </dd>
        <?php echo error_msg($errors['visible'], h($page['visible']))?>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
        </dd>
        <?php echo error_msg($errors['content'], "")?>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>
  </div>
</section>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>



