<?php
session_start();

// root link
DEFINE ("BASE_LINK", "/home_maintenance_manager/public/");

$_SESSION['userNameError'] = '';
$_SESSION['emailError'] = '';

//if signed in, show 'header-signedin.php' other wise 'header.php'
if(isset($_SESSION['loggedin'])){
    require_once("../public/header-signedin.php");
}
elseif(isset($_SESSION['managerloggedin'])) {
    require_once("../public/header-manager-signedin.php");
}
elseif(isset($_SESSION['limitedloggedin'])) {
    require_once("../public/header-limited-signedin.php");
}
else {
    require_once("../public/header.php");
}
