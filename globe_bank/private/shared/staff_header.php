<?php 

    if(!isset($pageTitle)){
         $pageTitle = "Staff Area";
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>GBI - <?php echo h($pageTitle); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css');?>" />
  </head>
  <body>
    <header>
      <h1>GBI Staff Area</h1>
    </header> 

    <?php 
    if(is_logged_in()){     
       
      $nav ='<navigation>';
      $nav .='<ul>';
      $nav .='<li>User '.$_SESSION['username'] ?? 'Username nof found'.'</li>';
      $nav .='<li><a href="'.url_for('/staff').'">Menu</a></li>';
      $nav .='<li><a href="'.url_for('staff/logout.php').'">Logout</a></li>';
      $nav .='</ul>';
      $nav .='</navigation>'; 

      echo $nav;
    }
    ?>
    <main>
     
 