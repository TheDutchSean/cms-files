<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/sonnet.txt';

// like editing a word file it can have a pointer, the pointer will not insert text from its position but overwrite it
// https://www.php.net/manual/en/function.ftell.php
// https://www.php.net/manual/en/function.fseek.php
$file = fopen($filePath , "r+");

if($file){
    
    echo ftell($file)."</br>";
    fread($file, 26);
    echo ftell($file)."</br>";
    fwrite($file, "winter");
    echo ftell($file)."</br>";
    fseek($file, 35);
    echo ftell($file)."</br>";
    fwrite($file, "eve");
    echo ftell($file)."</br>";
    fclose($file);

}
else{
    echo "could not open file";
}
?>

