<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);
?>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data["an"]] ?>">Appliance</a>

    <br><br>
    <h3>Update Appliance</h3>
    <hr>
    <br>
    <form action="" method="post">
        Appliance Name:<br> <input type="text" name="applianceName" value="<?php echo $_SESSION['appliancename' . $data["an"]] ?>"><br><br>
        Model:<br> <input type="text" name="applianceModel" value="<?php echo $_SESSION['appliancemodel' . $data["an"]] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

<?php
/**
* If form is submitted as post method, update appliance method is called.
* Appliance ID is passed as parameter in the update appliance method.
* Appliance ID $data['an'] is passed from ApplianceController class.
* 'an' is array of different appliance ID.
*/
if($_SERVER["REQUEST_METHOD"] == "POST") {
$applianceID = $_SESSION['applianceid' . $data['an']];
$applianceName = $_SESSION['appliancename' . $data["an"]];

$appliance->updateAppliance($applianceID, $applianceName);
}