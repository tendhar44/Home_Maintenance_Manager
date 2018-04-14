<?php
session_start();

// root link
DEFINE ("BASE_LINK", "/home_maintenance_manager/public/");

$_SESSION['userNameError'] = '';
$_SESSION['emailError'] = '';

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
