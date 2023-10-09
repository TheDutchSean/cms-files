<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 


$filePath = PRIVATE_PATH.'\files\dir_basics.php';
$dirPath = PRIVATE_PATH.'\files';

// https://www.php.net/manual/en/function.fopen.php
$dir = opendir($dirPath);

if($dir){

    // to prevent te loop from stoping if a file name starts with 0 we have to have a strict compare in the loop
    while(false !== ($entry = readdir($dir))){
        if($entry == "." || $entry == ".."){continue;}
        echo $entry . "<br/>";
    }
    
    closedir($dir);
    echo "succes";
}
else{
    echo "could not open file";
}

echo "<br/>";

$array = scandir($dirPath);
$contents = array_diff($array, ['.', '..']);
print_array($contents);


?>