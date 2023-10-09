<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php

    function getDirList($dirPath){

        if (is_dir($dirPath)) {
            $contents = scandir($dirPath);
            
            // Remove "." and ".." entries from the list
            $contents = array_diff($contents, ['.', '..']);
            
            return $contents;

        } 
        else {
            echo logError("The specified directory at ".$dirPath." does not exist.");
        }
    }


    function getFiles($dirPath){

        $files = [];
        $dir = [];

        foreach (getDirList($dirPath) as $item) {
            if(is_file($dirPath.'/'.$item)){
                array_push($files, $item);
            }
            else if(is_dir($dirPath.'/'.$item)){
                array_push($dir, $item);
            }   
        }

        return ['dir'=>$dir, 'files'=>$files];
    }

    function getAllFiles($dirPath){

        $files = [];

        foreach(getDirList($dirPath) as $item) {
            if(is_file($dirPath.'/'.$item)){
                array_push($files, $item);
            }
            else if(is_dir($dirPath.'/'.$item)){
                array_push($files,getAllFiles($dirPath.'/'.$item));
            }   
        }

        return $files;

    }

    function buildFileList($fileArray){

        $list = [];

        if(gettype($fileArray) == "array"){
            foreach($fileArray as $item){
                if(gettype($item) == "array"){
                    foreach(buildFileList($item) as $subItem){
                        array_push($list,$subItem);
                    } 
                }
                else{
                    array_push($list, $item);
                }
            }
        }
        else{
            return $fileArray;
        }

        return $list;


    }

?>