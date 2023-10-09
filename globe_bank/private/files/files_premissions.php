<?php 
    $filepath = "";
    $user = "";
    $group = "";
    
    
    // to use these functions php need te be the owner or have premissions on the file

    // see file_info.md for more information
    // !! php only works with octal notation !!
    // r = 4
    // w = 2
    // x = 1

//                  user    group   other
    // read         4       4       4
    // write        2       2       0
    // execute      1       0       0
    // octal code   7       6       4
    // Alpha  = 0764

    $mode = 0764;

    // https://www.php.net/manual/en/function.chown.php
    // changes the owner of an file
    chown($filepath, $user);

    // https://www.php.net/manual/en/function.chgrp.php
    // changes the group of the file
    chgrp($filepath, $group);

    // https://www.php.net/manual/en/function.chmod.php
    // changes the premissions of an file
    chmod($filepath, $mode);


?>

