<?php
require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

$userID = $data['uId'];
echo $data['uId'];
$user->deleteUser($userID);
$user->signOutUser();
header('Location: /home_maintenance_manager/public');
