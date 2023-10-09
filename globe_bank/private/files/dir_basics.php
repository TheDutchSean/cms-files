<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 


$filePath = PRIVATE_PATH.'\files\dir_basics.php';
$dirPath = PRIVATE_PATH.'\files';

// gets the current working dir
echo getcwd() . "</br>";

// change dir to shared
chdir('../../');

echo getcwd() . "</br>";

chdir('public');
echo getcwd() . "</br>";


?>