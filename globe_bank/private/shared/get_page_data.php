<?php
$response = db_query($getSubjects); 

// $position = ["" => 1];

if($response["succes"]){
  $subjects =  $response['data']; 

  $positions = [];
  foreach($subjects as $subject){

    $response = db_query($getPageCount, $subject);  
    
    if($response["succes"]){
      if(str_starts_with(strtoupper($pageTitle),"EDIT")){
        $count = $response['data'][0]['page_count'];
      }
      else{
        $count = $response['data'][0]['page_count'] + 1;
      }
      array_push($positions, ["id" => $subject["id"], "count" => $count]);   
    }; 

  }
}

?>

<script>
  
  const positions = <?php echo json_encode($positions) ?>;

</script>
<script src="<?php echo url_for('/scripts/positions_options.js');?>" type="module" defer></script>
