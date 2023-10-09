<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/sample_file.txt';

// delete a file using unlink
// https://www.php.net/manual/en/function.unlink.php

// file CANNOT be delete f:
// there opened ia fclose has not been used OR premissions have not been set to write
if(file_exists($filePath)){
    $result = unlink($filePath);

    if($result){
        echo "file at:".$filePath." succesfully deleted.";
    
    }
    else{
        echo "failed to delete file at:".$filePath.".";
    }
}
else{
    echo "cannot find file at:".$filePath.".";
}

?>
<hr>
<?php

$filePath = PUBLIC_PATH.'/assets/files/sample_file_2.txt';

$result = unlink($filePath);

if($result){
    echo "file at:".$filePath." succesfully deleted.";

}
else{
    echo "failed to delete file at:".$filePath.".";
}

?>