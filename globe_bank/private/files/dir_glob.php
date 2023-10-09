<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 


$filePath = PRIVATE_PATH.'\files\dir_basics.php';
$dirPath = PRIVATE_PATH.'\files';

// https://www.php.net/manual/en/function.glob.php

// the glob pattern
// ? Matches any one character
// * Matches zero or more characther
// [abc] Matches any character in the set
// [!abc] Matches any character not in the set
// Escapes the pattern charachters
chdir('../../');

echo getcwd() . "</br>";
chdir('logs');
$entries = glob("*/*.txt");

foreach($entries as $entry){
    echo $entry . "<br/>";
}

?>