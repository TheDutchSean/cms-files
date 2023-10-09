<?php require_once('../../../private/initialize.php'); 

  require_login();

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/subjects/"));
    exit;
  };

  $page = [];
  $page["id"] = $_GET['id'] ?? '0'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  $pageTitle = "View Page";
  include(SHARED_PATH . '/staff_header.php'); 

  $response = db_query($getPageByID, $page);   
  
  
  if($response["succes"]){
    $page =  $response['data'][0];   
  }
  else{
    $page =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  }

?>

<section id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id='.u(h($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>
    <div class="page show">
      <h1>Page: <?php echo h($page['menu_name']); ?></h1>
      <?php echo display_status(); ?>
      <div class="attributes">
          <dl>
            <dt>
            <a class="back-link" target='_blank' href="<?php echo url_for('/index.php?id='.h(u($page["id"]))."&preview=true"); ?>">Preview</a>
            </dt>
          </dl>
          <dl>
          <dt>Subject</dt>
          <dd><?php echo h($page['subject_name']); ?></dd>
          </dl>
          <dl>
          <dt>Menu Name</dt>
          <dd><?php echo h($page['menu_name']); ?></dd>
          </dl>
          <dl>
          <dt>Position</dt>
          <dd><?php echo h($page['position']); ?></dd>
          </dl>
          <dl>
          <dt>Visible</dt>
          <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
          </dl>
          <dl>
          <dt>Content</dt>
          <dd><?php echo h($page['content']); ?></dd>
          </dl>
          
    </div>
</section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  
