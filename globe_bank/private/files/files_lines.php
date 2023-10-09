<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/us_presidents.csv';

// read a file using file_get_contents
// https://www.php.net/manual/en/function.file-get-contents.php
$file = fopen($filePath , "r");

if($file){
    $data = "";
    // https://www.php.net/manual/en/function.fgets.php
    // https://www.php.net/manual/en/function.feof.php
    while(!feof($file)){
        $row = fgets($file); 
        $array = explode(",",$row);
        echo $array[1] . "<br>";
    }
    fclose($file);
    echo nl2br($data);

}
else{
    echo "could not open file";
}
?>
