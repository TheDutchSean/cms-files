<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once(substr(__FILE__,0,strpos(__FILE__, "globe_bank")+10).$initPath);
?>
<?php 

if(!isset($_POST['submit'])){
    redirect("index.php");
    exit;
};

    // get the file data from the form post request in input_files.php "file_upload"
    $files = $_FILES['file_upload'];
    $filename = basename($files['name']);

    // https://www.php.net/manual/en/features.file-upload.errors.php

    $file_errors_msg = [
        "The uploaded file exceeds the upload_max_filesize", 
        "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        "The uploaded file was only partially uploaded",
        "No file was uploaded",
        "",
        "Missing a temporary folder",
        "Failed to write file to disk",
        "A PHP extension stopped the file upload"
    ];

    if($files["size"] > 1002400){
        echo "<p>".$file_errors_msg[0]."</p>";
        exit;
    }

    if($files["error"] > 0){
        logError($files["error"]."-".$file_errors_msg[$files["error"]].": file:".$filename.", type:".$files['type'].", size:".$files['size']."kb. See https://www.php.net/manual/en/features.file-upload.errors.php for more info");
        if($files["error"] >= 1 && $files["error"] <= 4){
            echo "<p>".$file_errors_msg[$files["error"]]."</p>";
        }
        else{
            echo "<p>could not upload file due to internal server error, try again in a few minutes</p>";
        }
        redirect("index.php");
        exit;
    }

    $image_types = ["image/png", "image/gif", "image/jpeg"];

    if(!in_array($files["type"], $image_types)){
        echo "<p>Error uploaded file is not of the image type</p>";
        exit;
    }

    // if(!str_contains($files["type"],"image")){
    //     echo "<p>Error uploaded file is not of the image type</p>";
    //     exit;
    // }
        
    $targetDir = __DIR__. "/upload/foto";
    // use basename to remove unwanted charachters from the file name

    $targetPath = $targetDir."/".$filename;

    if(!file_exists($targetDir)){
        mkdir($targetDir);
    }

    if(!file_exists($targetPath)){
        // move_uploaded_file moves the file from the tmp location to the defined target path
        // https://www.php.net/manual/en/function.move-uploaded-file.php
        move_uploaded_file($files["tmp_name"], $targetPath);

    }  
    

?>
<style>

    img {
        width:400px;
    }

</style>
<a href="index.php">Back</a>
<br/>
<img src="<?php echo "upload/foto/".$filename;?>" alt="<?php echo $filename?>"/> 