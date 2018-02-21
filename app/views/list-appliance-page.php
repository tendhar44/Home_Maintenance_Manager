<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

//$propertyId = $data["proId"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $appliance->addAppliance();
}
?>

<br>
<a href="/home_maintenance_manager/public/appliancecontroller/add/<?php echo $data['proId']; ?>">+ Add Appliance</a>

<?php
echo "<br><br>";

$propertyId = $data["proId"];
$appliance->getListOfAppliances($propertyId);