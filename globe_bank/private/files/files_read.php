<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/lorem_ipsum.txt';

// read a file using fread with a pre defined size
$file = fopen($filePath , "r");

if($file){
    // https://www.php.net/manual/en/function.fread.php
    $data = fread($file, 20);
    fclose($file);
    echo $data;

}
else{
    echo "could not open file";
}
?>
<hr>
<?php
// read a complete file using fread en filesize

$bytes = filesize($filePath);
$file = fopen($filePath , "r");

if($file){
    // https://www.php.net/manual/en/function.fread.php
    $data = fread($file, $bytes);
    fclose($file);
    // use nl2br to convert linebreaks to <br>
    echo nl2br($data);

}
else{
    echo "could not open file";
}

?>