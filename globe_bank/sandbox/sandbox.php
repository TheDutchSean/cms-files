<?php 

require_once(PRIVATE_PATH."/functions_db.php");


function myCallBack($connection){

    if(!isset($connection)){
        return ["succes" => false, "data" => []];
    } 


    $query = "SELECT * FROM subjects ORDER BY position ASC";

    $result_set = mysqli_query($connection, $query);
    $result = [];

    for($i = 0; $i < mysqli_num_rows($result_set); $i++){
        array_push($result,mysqli_fetch_assoc($result_set));      
    }

    mysqli_free_result($result_set);
    return ["succes" => true, "data" => $result];
    

};

$myCBfunc = 'myCallBack';

echo "test";

// function to inspect result from query
function echo_result($query){
    echo "<pre>";
    // print_r(run_mySQL_PS($query));
    print_r(run_mySQL_cb($query));
    echo "</pre>";
}

echo_result($myCBfunc);
// echo_result("SELECT * FROM subjects ORDER BY position ASC");



// query test to set headers
$test = $_GET['test'] ?? '';

if($test == "404"){
    error_404();
}
elseif($test == "500"){
    error_500();
}
elseif($test == "redirect"){
    redirect(url_for("/staff/subjects/index.php"));
}



//const query build up 
const QUERY = [
    "getSubjects" => "getSubjects",
    "getSubjectByID" => "getSubjectsByID",
    "getPages" => "getPages"
];

function query($function, $arg="" ){
    
    if(gettype($function) != "string"){
        return "";
    }

    if(!is_callable(QUERY[$function])){
        return "";
    }
    
    if(gettype($arg)  == 'string'){
        return call_user_func(QUERY[$function],$arg);
    }
    else if(gettype($arg) == 'array'){
        return call_user_func_array(QUERY[$function],$arg);
    }
    return;
}


$page["id"] = 10;
$page["menu_name"] = 'A name';
$page["subject_id"] = '1';
$page["position"] = '2';
$page["visible"] = '0';
$page["content"] = 'some content';
  
  $keys = array_keys($page);
  $update = ["table" => "pages"];
  foreach($keys as $key){
    array_push($update, ["column" => $key,"value" => $page[$key]]);
  }

  $value = [];
  echo array_search("table", );
    array_splice($update, 0 ,1);

    echo "<pre>";
    echo print_r($update);
  echo "</pre>";

?>
