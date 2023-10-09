<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once(substr(__FILE__,0,strpos(__FILE__, "globe_bank")+10).$initPath);
?>

<form action="upload_foto.php" method="POST" enctype="multipart/form-data">
    <!-- add to limit the maxium file size -->
    <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />    
    <input type="file" name="file_upload" /><br/>
    <input type="submit" name="submit" value="Upload" />
</form>