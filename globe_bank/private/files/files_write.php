<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/sample_file.txt';

// wrtie a file using fwrite, if the file does not exist it will create it
// https://www.php.net/manual/en/function.fwrite.php
$file = fopen($filePath , "w");

if($file){
    
    $data = "1,2,3,4,5,6,7,8,9,0";
    
    fwrite($file, $data);
    fclose($file);
    echo $data;

}
else{
    echo "could not open file";
}
?>
<hr>
<?php

// To add a line return in Unix or macOS:
// Line one\nLine two

// Windows
// Line one\r\nLine two

// Lateste versions of Windows support \n only

$file = fopen($filePath , "a");

if($file){
    
    $data = "\r\na,b,c,d,e,f\n!,@,#,$,%";
    
    fwrite($file, $data);
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