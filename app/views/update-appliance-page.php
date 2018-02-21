<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

echo $data["an"];
?>

<div class="container">
    <form action="" method="post">
        Appliance Name: <input type="text" name="applianceName" value="<?php echo $_SESSION['appliancename' . $data["an"]] ?>">
        Model: <input type="text" name="applianceModel" value="<?php echo $_SESSION['appliancemodel' . $data["an"]] ?>">
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
echo $applianceID;
$appliance->updateAppliance($applianceID);
}