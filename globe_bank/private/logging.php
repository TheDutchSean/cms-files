<?php 
    // get initialize.php 
    $fileDir = strpos(__FILE__, "\private") > 0 ? "private" : "public";
    $initPath = substr(__FILE__,0,strpos(__FILE__,"\\".$fileDir."\\")).'\private\initialize.php';
    require_once($initPath);
?>
<?php 

    $logFormat = '%Y/%m/%d %H:%M:%S';

    function logAction($msg){

        global $logFormat;

        global $logFolders;

        $folder = "";
        if($logFolders['actions'] !== ""){
            $folder .= $logFolders['actions'].'\\';
        }

        $logPath = LOG_PATH."\\".$folder.getISODate()."_actions.txt";

        $file = fopen($logPath , "a");

        if($file){
            
            $log = strftime($logFormat) . " - ".$msg.".\n";
            
            fwrite($file, $log);
            fclose($file);

        }
        else{
            logError("Action log error - could not find file at:".$logPath);
        }

    }

    function logUser($msg){

        global $logFormat;

        global $logFolders;

        $folder = "";
        if($logFolders['users'] !== ""){
            $folder .= $logFolders['users'].'\\';
        }

        $logPath = LOG_PATH.'\\'.$folder.getISODate()."_user.txt";

        $file = fopen($logPath , "a");

        if($file){
            
            $log = strftime($logFormat) . " - ".$msg.".\n";
            
            fwrite($file, $log);
            fclose($file);

        }
        else{
            logError("User log error - could not find file at:".$logPath);
        }

    }

    function logError($msg){

        global $logFormat;

        global $logFolders;
        $folder = "";
        if($logFolders['errors'] !== ""){
            $folder .= $logFolders['errors'].'\\';
        }

        $logPath = LOG_PATH.'\\'.$folder.getISODate()."_errors.txt";
        
        $file = fopen($logPath , "a");

        if($file){
            
            $log = strftime($logFormat) . " - ".$msg.".\n";
            
            fwrite($file, $log);
            fclose($file);

        }
    }

    function SQLError($msg){

        global $logFormat;

        global $logFolders;
        $folder = "";
        if($logFolders['sql'] !== ""){
            $folder .= $logFolders['sql'].'\\';
        }

        $logPath = LOG_PATH."\\".$folder.getISODate()."_sql_errors.txt";
        
        $file = fopen($logPath , "a");

        if($file){
            
            $log = strftime($logFormat) . " - ".$msg.".\n";
            
            fwrite($file, $log);
            fclose($file);

        }
        else{
            logError("SQL log error - could not find file at:".$logPath);
        }
    }
    
    function mLogDir(){

        global $logFolders;

        if(!file_exists(LOG_PATH)){
            mkdir(LOG_PATH);
        }

        foreach($logFolders as $item){

            $folder = "";
            if($item == ""){
                continue;
            }

            $logPath = LOG_PATH."\\".$item;

            if(!file_exists($logPath)){
                mkdir($logPath);
            }           
        }
    }

    

?>