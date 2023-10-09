<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once(substr(__FILE__,0,strpos(__FILE__, "globe_bank")+10).$initPath);
?>
<?php

    $path =  __DIR__."/treasure_hunt";


    function treasure($path){

        $contents = getDirList($path);

        foreach($contents as $item){
            // echo $path."\\".$item;
            if(is_file($path."\\".$item)){
                $bytes = filesize($path."\\".$item);
                $file = fopen($path."\\".$item , "r");
                
                if($file){
                    // https://www.php.net/manual/en/function.fread.php
                    $data = fread($file, $bytes);
                    if(str_contains($data, "treasure....")){
                        echo $path."\\".$item . "<br/>";
                    }
                    fclose($file);
   
                }
                else{
                    echo "could not open file";
                }
            }
            else if(is_dir($path."\\".$item)){
                treasure($path."\\".$item);
            }
    
        }

    }

    treasure($path)
?>