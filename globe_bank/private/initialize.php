<?php
    ob_start(); // output buffering is turned on
    
    // start session
    session_start();

    // Assign file paths to PHP constants
    // __FILE__ returns the current path to this file
    // dirname() returns the path to the parent directory
    define("PRIVATE_PATH",  dirname(__FILE__));
    define("PROJECT_PATH",  dirname(PRIVATE_PATH));
    define("PUBLIC_PATH",   PROJECT_PATH . '/public');
    define("SHARED_PATH",   PRIVATE_PATH . '/shared');

    define("LOG_PATH", PROJECT_PATH.'\logs\\');

    // Assign the root URL to a PHP constant
    // * Do not need to include the domain
    // * Use same document root as webserver
    // * Can set a hardcoded value:
    // define("WWW_ROOT", '/~kevinskoglund/globe_bank/public');
    // define("WWW_ROOT", '');
    // * Can dynamically find everything in URL up to "/public"
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('config.php');

    require_once("db_validation.php");
    require_once('functions.php');
    require_once("functions_db.php");
    require_once('functions_validate.php'); 
    require_once('functions_files.php');
    require_once("functions_time.php");
    require_once('querys.php'); 
    require_once('auth_functions.php'); 
    require_once('debug.php'); 
    require_once('logging.php'); 
    
  
    // files
  
    $admins = [];
    $admin["first_name"] = '';
    $admin["last_name"] = '';
    $admin["email"] = '';
    $admin["username"] = '';
    $admin["password"] = '';
    $admin["confirm_password"] = "";

    $subject = [];
    $subject["id"] = ""; // == if(isset($_GET['id']){$id=$_GET['id']}else{$id='1'}); || $id = isset($_GET['id'] ? isset($_GET['id'] : '1';
    $subject['menu_name'] = '';
    $subject['position'] = '';
    $subject['visible'] = '';

    $errors = [];
    $errors['menu_name'] = "";
    $errors['subject_id'] = "";
    $errors['position'] = "";
    $errors['visible'] = "";
    $errors['content'] = "";
    $errors['first_name'] = "";
    $errors['last_name'] = "";
    $errors['email'] = "";
    $errors['username'] = "";
    $errors['password'] = "";
    $errors['confirm_password'] = "";
    $errors['submit'] = "";

    // create log directory
    mLogDir();

?>
 