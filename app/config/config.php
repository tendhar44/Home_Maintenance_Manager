<?php
//Start our session.
session_start();
 
//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 30;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();

        //code not working.
            // echo '<script language="javascript">';
            // echo 'alert("Session time out, Please Login again");';
            // echo 'window.location.href = "/home_maintenance_manager/public/usercontroller/signin";';
            // echo '</script>';
    }
    
}
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();


// root link
DEFINE ("BASE_LINK", "/home_maintenance_manager/public/");

$_SESSION['userNameError'] = '';
$_SESSION['emailError'] = '';
$_SESSION['signInError'] = '';

//if signed in, show 'header-signedin.php' other wise 'header.php'
if(isset($_SESSION['owner']) && $_SESSION['owner']){
	require_once("../public/header-signedin.php");
}
elseif(isset($_SESSION['manager']) && $_SESSION['manager']) {
	require_once("../public/header-manager-signedin.php");
}
elseif(isset($_SESSION['limitedUser']) && $_SESSION['limitedUser']) {
	require_once("../public/header-limited-signedin.php");
}
else {
	require_once("../public/header.php");
}
