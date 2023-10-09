<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once(substr(__FILE__,0,strpos(__FILE__, "globe_bank")+10).$initPath);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Globe Bank</title>
    <meta charset="utf-8">
  </head>

  <body>
    <h1>Sandbox</h1>
    <?php 

        include('input_foto.php');
        // include("./sandbox.php");


    ?>
  </body>
</html>