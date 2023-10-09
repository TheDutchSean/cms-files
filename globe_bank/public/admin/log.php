<?php require_once('../../private/initialize.php'); 

  require_login();

  $pageTitle = "Server Admins - logs";

  $logEvent = "";
  $logDate = "";
  $logSearch = "";
  $log = "";

  if(is_post_request()){

    $logEvent = $_POST['event'] ?? '';
    $logDate = $_POST['date'] ?? '';
    $logSearch = $_POST['search'] ?? ''; 

    $filePath = LOG_PATH.$logFolders[$logEvent]."/".$logDate."_".$logEvent.".txt";

    $file = fopen($filePath , "r");

    if($file){
        $data = "";
        // https://www.php.net/manual/en/function.fgets.php
        // https://www.php.net/manual/en/function.feof.php
        while(!feof($file)){
            $data .= fgets($file); 
        }
        fclose($file);
        $log = nl2br($data);

    }
    else{
      logError("could not find file at:".$filePath);
    }
  
  }

  $contents = getAllFiles(LOG_PATH);

  $list = buildFileList($contents);
  $logOptions = [];
  foreach($list as $file){

    $fileChunk = explode("_",$file);

    $date = $fileChunk[0];
    $event = explode(".",$fileChunk[1])[0];

    if(key_exists($event, $logOptions)){
      if(!in_array($date, $logOptions[$event])){
        array_push($logOptions[$event],$date);
      }    
    }
    else{
      $logOptions[$event] = [$date];
    }
  }

  $eventOptions = array_keys($logOptions);

  
  include(SHARED_PATH . '/staff_header.php'); 
?>

    <section id="content">
      <div class="admin listing">
      <h1>Server Admin</h1>
        <div class="actions">
        <a class="action" href="<?php echo url_for('admin/'); ?>">Back</a>
        </div>
        <form action="<?php echo url_for('/admin/log.php?event='.u(h($logEvent)).'&date='.u(h($logDate)).'&search='.u(h($logSearch))); ?>" method="post">
            <div>
                <select name="event">
                  <option value="all" <?php if($logEvent == "all"){ echo "selected";} ?>>all</option>
                  <?php 
                    foreach($eventOptions as $option){ ?>
                      <option value="<?php echo $option ?>" <?php if($logEvent == $option){ echo "selected";} ?>><?php echo $option ?></option>
                  <?php 
                    }
                  ?>
                </select>
                <select name="date">
                  <?php 
                  // TO DO SHOW label date correct
                    foreach($logOptions[$logEvent] as $option){ ?>
                      <option value="<?php echo $option ?>" <?php if($logDate == $option){ echo "selected";} ?>><?php echo $option ?></option>
                  <?php 
                    }
                  ?>
                </select>
                <div>        
                  <p>Search</p>
                  <input type="text" name="search" value="<?php echo h($logSearch);?>" />
                </div>
                <div id="operations">
                  <input type="submit" value="Search" />
                </div>
            </div>

                <p>
                    <?php 
                    echo $log;


                ?>
            </p>  

        </form>    
      </div>
    </section> 

<?php include(SHARED_PATH . '/staff_footer.php'); ?>  