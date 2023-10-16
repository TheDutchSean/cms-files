<?php  

require_once('db_config.php');
// mysqli_report(MYSQLI_REPORT_STRICT);
// I had the same issue and I solved it with a try/catch block.  I just changed the db_connect code in the database.php file to: Added mysqli_report(MYSQLI_REPORT_STRICT); right after the require_once ('db_credentials.php');, then I added a try/catch block and in the try area I included the code for $connection and return $connection.  In the catch area I added catch(mysqli_sql_exception $e) { confirm_db_connect(); } So if an error is detected with the database connection in the catch string it will print out the message we created in the confirm_db_connect function.  Added benefit is that no other error messages will print out except the one we want to show.



function db_select($connection, $query){

    $validate = db_validate_func_input($connection, $query);
    
    if(!$validate["valid"]){
        return ["succes" => false, "data" => $validate["msg"]];
    }

    $result_set = [];

    // try block added to stop php from generating fatal error
    try{
        $result_set = mysqli_query($connection, $query);

        $result = [];

        // if(mysqli_num_fields($result_set) <= 1 && mysqli_num_rows($result_set) <= 1){
        //     $result = mysqli_fetch_row($result_set)[0];
        // }
        // else if(mysqli_num_fields($result_set) <= 1){
        //     for($i = 0; $i < mysqli_num_rows($result_set); $i++){
        //         array_push($result,mysqli_fetch_row($result_set)[$i]);      
        //     }   
        // }
        // else 
        
        // if(mysqli_num_rows($result_set) <= 1){
        //     array_push($result, mysqli_fetch_assoc($result_set));  
        // }
        // else{
            for($i = 0; $i < mysqli_num_rows($result_set); $i++){
                array_push($result,mysqli_fetch_assoc($result_set));      
            }     
        // }

        mysqli_free_result($result_set);
        
        return ["succes" => true, "data" => $result];
    }
    catch(mysqli_sql_exception $e){  
        error_log($e);
        if(!$result_set){
            return db_error($connection); 
        }
    };  

}

function db_insert($connection, $query){
    
    $validate = db_validate_func_input($connection, $query);

    if(!$validate["valid"]){
        return ["succes" => false, "data" => $validate["msg"]];
    }
        
    try{
        $response = mysqli_query($connection, $query);

        if($response){
            return ["succes" => true, "data" => mysqli_insert_id($connection)];
        }
        else{
            return db_error($connection);
        }   

    }
    catch(mysqli_sql_exception $e){  
        error_log($e);
        return db_error($connection);      
    };
};

function db_update($connection, $query){

    $validate = db_validate_func_input($connection, $query);

    if(!$validate["valid"]){
        return ["succes" => false, "data" => $validate["msg"]];
    }
        
    try{
        $response = mysqli_query($connection, $query);

        if($response){
            return ["succes" => true, "data" => ""];
        }
        else{
            return db_error($connection);
        }   

    }
    catch(mysqli_sql_exception $e){  
        error_log($e);
        return db_error($connection);      
    };
};

function db_delete($connection, $query){
    
    $validate = db_validate_func_input($connection, $query);

    if(!$validate["valid"]){
        return ["succes" => false, "data" => $validate["msg"]];
    }
        
    try{
        $response = mysqli_query($connection, $query);

        if($response){
            return ["succes" => true, "data" => ""];
        }
        else{
            return db_error($connection);
        }   

    }
    catch(mysqli_sql_exception $e){  
        error_log($e);
        return db_error($connection);      
    };
};

function db_dml_query($connection, $query){

    $validate = db_validate_func_input($connection, $query);

    if(!$validate["valid"]){
        return ["succes" => false, "data" => $validate["msg"]];
    }

    // query select
    if(str_starts_with($query, "SELECT")){
        return db_select($connection, $query);
    }
    // query insert
    else if(str_starts_with($query, "INSERT")){
        return db_insert($connection, $query);
    }   
    // query update
    else if(str_starts_with($query, "UPDATE")){
        return db_update($connection, $query);
    }
    else if(str_starts_with($query, "DELETE")){
        return db_delete($connection, $query);
    } 
    return ["succes" => false, "data" => "invalid query"];
// end db_mll_query
};

function db_connect($dbInfo=DB_CONNECT){
    return mysqli_connect($dbInfo['HOST'],$dbInfo['USER'],$dbInfo['PASS'],$dbInfo['NAME']);
};

function db_close($connection){
    mysqli_close($connection);
    return;
};

// Obejct Orientated 
function run_mySQL_OOS($callback, $dbInfo=DB_CONNECT){

    // if(!isset($callback)){
    //     return [];
    // }    

    // $mySQL = new mysqli;
    // $mySQL -> real_connect(

    // );


    // return $callback;
        return;
};

// P..... S..... way of using sql
function db_query($query_func, $values = [], $dbInfo=DB_CONNECT){

    if(!is_callable($query_func)){
        return ["succes" => false, "data" => "query needs to be a function."];
    }    
    
    // try block added to stop php from generating fatal error
    try{
        $connection = db_connect($dbInfo); 
    }
    catch(mysqli_sql_exception $e){
        $check = check_db_con();
        error_log($e);
        error_log($check['msg']);
        if(!$check["succes"]){
            return $check;
        }
    } 

    $checked_values = []; 

    if(gettype($values) == "array"){
         
        $keys = array_keys($values);
    
        foreach($keys as $key){
            if(isset($values[$key]) && trim($values[$key]) != ""){
                $checked_values[$key] = db_escape($connection, $values[$key]);
            }    
        };

    }
    else{
        $checked_values = db_escape($connection, $values);
    }

    $query = $query_func($checked_values);

    $response = db_dml_query($connection, $query);
    db_close($connection);

    return $response;

};

function db_query_save($query, $dbInfo=DB_CONNECT){

    if(!isset($query) || gettype($query) != "string"){
        return [];
    }    
    
    // try block added to stop php from generating fatal error
    try{
        $connection = db_connect($dbInfo); 
    }
    catch(mysqli_sql_exception $e){
        $check = check_db_con();
        error_log($e);
        error_log($check['msg']);
        if(!$check["succes"]){
            return $check;
        }
    } 

    $response = db_dml_query($connection, $query);
    db_close($connection);

    return $response;

};

function check_db_con(){

    if(mysqli_connect_errno()){
        return ["succes" => false, "msg" => "Database connection failed:[".mysqli_connect_errno()."] ".mysqli_connect_error().""];
    }
    else{
        return ["succes" => true, "msg" => "Database connection established."];
    };

};



function db_validate_func_input($connection, $query){
    
    if(!isset($connection)){
        return ["valid" => false, "error" => "no connection defined"];
    }; 

    if(gettype($connection) != "object"){
        return ["valid" => false, "error" => "connection not of type object"];
    }; 

    if(!isset($query)){
        return ["valid" => false, "error" => "no query defined"];
    }; 

    if(gettype($query) != "string"){
        return ["valid" => false, "error" => "query not of type string"];
    }; 

    return ["valid" => true, "error" => ""];
};


function db_escape($connection, $value){
    return mysqli_real_escape_string($connection, $value);
};

// P..... S..... with SQL see sandbox.php for use case
function run_mySQL_cb($callback, $dbInfo=DB_CONNECT){
    
    if(!isset($callback)){
        return [];
    };   

    $connection = db_connect($dbInfo);  
    $response = $callback($connection);
    db_close($connection);
    return $response;

};

function db_error($connection){
    $error = mysqli_error($connection);
    SQLError($error);
    return ["succes" => false, "data" => $error];
};


?>