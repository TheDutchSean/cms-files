<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 


    $filePath = PRIVATE_PATH.'\files\files_basics.php';
    $dirPath = PRIVATE_PATH.'\files';

?>
<p><?php echo $filePath; ?></p>
<p><?php echo file_exists($filePath) ? "exists" : "none"; ?></p>
<p><?php echo is_file($filePath) ? "file" : "not a file"; ?></p>
<p><?php echo is_dir($filePath) ? "directory" : "not a directory"; ?></p>
<br>
<hr>
<br>
<p><?php echo $dirPath; ?></p>
<p><?php echo file_exists($dirPath) ? "exists" : "none"; ?></p>
<p><?php echo is_file($dirPath) ? "file" : "not a file"; ?></p>
<p><?php echo is_dir($dirPath) ? "directory" : "not a directory"; ?></p>
<hr>