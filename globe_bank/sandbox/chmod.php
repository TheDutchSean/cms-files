<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once(substr(__FILE__,0,strpos(__FILE__, "globe_bank")+10).$initPath);
?>
<?php 
    $filepath = __DIR__. "/upload/chmod.txt";
      
    // to use these functions php need te be the owner or have premissions on the file

    // see file_info.md for more information
    // !! php only works with octal notation !!
    // r = 4
    // w = 2
    // x = 1

//                  user    group   other
    // read         4       4       4
    // write        2       2       0
    // execute      1       0       0
    // octal code   7       6       4
    // Alpha  = 0764

    $mode = 0777;

    // https://www.php.net/manual/en/function.chmod.php
    // changes the premissions of an file
    if(file_exists($filepath)){
        echo $mode;
        chmod($filepath, $mode);
    }
    


?>

