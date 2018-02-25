<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

$applianceID = $_SESSION['applianceid' . $data['an']];
$appliance->deleteAppliance($applianceID);
echo "<br><br>";
?>

<div class="container" id="info">

<a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data['an']]; ?>"><-- Back to Appliance List</a>
</div>