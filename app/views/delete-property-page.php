<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

echo $data["pn"];

$propertyID = $_SESSION['propertyid' . $data['pn']];
echo $propertyID;
$property->deleteProperty($propertyID);
echo "<br><br>";
?>

<a href="/home_maintenance_manager/public/propertycontroller"><-- Back to Property List</a>