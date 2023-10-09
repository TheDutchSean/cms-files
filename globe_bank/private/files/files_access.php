<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 
// https://www.php.net/manual/en/function.fopen.php
$file = fopen(PUBLIC_PATH.'/assets/files/lorem_ipsum.txt', "r");

if($file){
    fclose($file);
    echo "succes";
}
else{
    echo "could not open file";
}



?>