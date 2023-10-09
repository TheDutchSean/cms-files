<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

$filePath = PUBLIC_PATH.'/assets/files/sonnet.txt';

// wrtie a file using fwrite, if the file does not exist it will create it
// https://www.php.net/manual/en/function.is-readable.php
// https://www.php.net/manual/en/function.is-writable.php
// https://www.php.net/manual/en/function.is-executable.php


echo "file at:".$filePath.",</br>";

?>
<hr>
<?php 

echo "is readable: ";
echo is_readable($filePath) ? "Yes" : "No";
echo ",<br>";
echo "is writeable: ";
echo is_writeable($filePath) ? "Yes" : "No";
echo ",<br>";
echo "is executable: ";
echo is_executable($filePath) ? "Yes" : "No";

?>
<hr>
<?php 

// https://www.php.net/manual/en/function.filemtime.php
// https://www.php.net/manual/en/function.filectime.php
// https://www.php.net/manual/en/function.fileatime.php 

echo "last modified: ";
echo strftime('%n/%d/%Y %H:%M',filemtime($filePath));
echo ",<br>";
echo "created: ";
echo strftime('%n/%d/%Y %H:%M',filectime($filePath));
echo ",<br>";
echo "last accessed: ";
echo strftime('%n/%d/%Y %H:%M',fileatime($filePath));

// https://www.php.net/manual/en/function.pathinfo.php


?>
<hr>
<?php 

// https://www.php.net/manual/en/function.pathinfo.php
$path = pathinfo($filePath);

echo "full path: ";
echo $path['dirname'];
echo ",<br>";
echo "file: ";
echo $path['basename'];
echo ",<br>";
echo "file extension: ";
echo $path['extension'];
echo ",<br>";
echo "file name: ";
echo $path['filename'];

?>