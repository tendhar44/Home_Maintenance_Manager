<?php
require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'homecontroller', $userSigned);

$user->signOutUser();
?>

<p>Successfully signed out</p>

<?php
header("location: /home_maintenance_manager/public/homecontroller");
?>