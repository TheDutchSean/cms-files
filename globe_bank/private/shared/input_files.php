<?php 

require_once('../initialzie.php');

?>
<form action="upload.php" methode="POST" enctype="multipart/form-data">
    <input type="file" name="file_upload" />
    <input type="submit" name="submit" value="Upload" />
</form>