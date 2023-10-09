<?php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>

<?php 

  $page = [];
  $subject = [];
  $subject["id"] = 0;
  // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';
  $preview = false;

  if(isset($_GET['preview']) && is_logged_in()){
    $preview = $_GET['preview'];
    // if($_GET['preview']){
    //   $getVisible = false;
    // }
  }
  $getVisible = !$preview;


  if(isset($_GET['subject_id'])){
    $subject['id'] = $_GET['subject_id'];
    // $subject['getVisible'] = true;
    $getOptions = ['id' => $subject['id'], 'getVisible' => $getVisible];
    $response = db_query($getPageBySubID, $getOptions);
    
    if($response["succes"] && isset($response['data'][0])){
      $page =  $response['data'][0];
    }
    else{
      // echo '<p>Sorry, failed to load.</br>Please try again in a minute.</p>';
      // exit;
    }
  
  }
  else if(isset($_GET['id'])){
    // $page["id"] = $_GET['id'];
    // $page['getVisible'] = true;
    $getOptions = ['id' => $_GET['id'], 'getVisible' => $getVisible]; 

    $response = db_query($getPageByID, $getOptions);  
    if($response["succes"] && isset($response['data'])){
      $page =  $response['data'][0];   
    }
    else{
      // echo '<p>Sorry, failed to load.</br>Please try again in a minute.</p>';
      // exit;
    }
  }

  if($page){
    $pageTitle = $page['menu_name'];
    $subject["id"] = $page["subject_id"];
  }

?>


<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">
    <?php 
      if(isset($page['content']) && ($page['visible'] || !$getVisible)){
        $allowed_tags = "<div><img><h1><h2><p><br><strong><em><ul><li>";
        echo strip_tags($page['content'], $allowed_tags);
      }
      else{
        // Show the homepage
        // The homepage content could:
        // * be static content (here or in a shared file)
        // * show the first page from the nav
        // * be in the database but add code to hide in the nav
        include(SHARED_PATH . '/static_homepage.php');
      }
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

