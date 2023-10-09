<?php require_once('../../../private/initialize.php'); 

  require_login();

  if(!isset($_GET['id'])){
    redirect(url_for("/staff/pages/"));
    exit;
  };

  $page = [];
  $page["id"] = $_GET['id'] ?? '0'; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';

  $response = db_query($getPageByID, $page);   

  if($response["succes"]){
    $page =  $response['data'][0];   
  }
  else{
    $page =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
  };

if(is_post_request()){

    $page['table'] = "pages";
    
    $position = [
      "current" => $page['position'],
      "new" => 0,
      "id" => $page['id'], 
      "table" => $page['table'],
      "subject_id" => $page['subject_id']
    ];    
    
    $response = db_query($setPositions, $position); 
    
    // delete page
    $response = db_query($deletePage, $page);   

    if(!$response["succes"]){
        echo "<p>mysqli_error:".$response["data"]."</p></br>"; 
        echo "<a href=".url_for("/staff/pages/delete.php?id={$id}").">back<a>";
        exit;
    }
    else{    
        $_SESSION['status'] = "Operation succes: page " . $page["menu_name"] . " has been removed.";
        if($config['log']['actions']){
          logAction("User:".$_SESSION['username']." has removed page ".$page["menu_name"]);
        }
        redirect(url_for('/staff/subjects/show.php?id='.u(h($page['subject_id']))));
    }; 
  }
  // else{
    // echo $page["id"];
    // $response = db_query($getPageByID, $page);   

    // if($response["succes"]){
    //   $page =  $response['data'];   
    // }
    // else{
    //   $page =  [['id' => 'failed to load please try again', 'position' => '', 'visible' => '', 'menu_name' => '']];   
    // };
  // };

  $pageTitle = "Delete Page";
  include(SHARED_PATH . '/staff_header.php'); 
?>

<section id="content">  
  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id='.u(h($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>
  <div class="pages delete">
    <h1>Delete Page</h1>
    <p>Are you sure you want to delete this page?</p>
    <p class="item"><?php echo h($page['menu_name']); ?></p>
    <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>
</section>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  