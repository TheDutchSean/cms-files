<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin["username"];
    logUser("id:".$_SESSION['admin_id']." - name:".$_SESSION['username']." logged in");
    return true;
  }

  // to remove seesion data you can use 
  // unset($_SESSION['username']);
  // or you could use
  // $_SESSION['username'] = NULL;

  function log_out_admin(){
    logUser("id:".$_SESSION['admin_id']." - name:".$_SESSION['username']." loged out");
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    
    // $_SESSION['login_out'] = time();
    // session_destroy(); // optional to delete all the session data
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect(url_for('/staff/login.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }


?>
