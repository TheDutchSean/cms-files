<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/sample_file_2.txt';

// wrtie a file using fwrite, if the file does not exist it will create it
// https://www.php.net/manual/en/function.file-put-contents.php
    
    $data = "A page of data!";
    
    file_put_contents($filePath, $data);

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