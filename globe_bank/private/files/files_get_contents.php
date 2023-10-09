<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/lorem_ipsum.txt';

// read a file using file_get_contents
// https://www.php.net/manual/en/function.file-get-contents.php
$file = file_get_contents($filePath , "r");

if($file){
    echo nl2br($file);

}
else{
    echo "could not open file";
}
?>
