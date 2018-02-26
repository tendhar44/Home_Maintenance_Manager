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

    <br><br>
    <h3>Update Property</h3>
    <hr>
    <br>
    <form action="" method="post">
        Property Name:<br> <input type="text" name="propertyname" value="<?php echo $_SESSION['propertyname' . $data["pn"]] ?>"><br><br>
        Address:<br> <input type="text" name="address" value="<?php echo $_SESSION['propertyaddress' . $data["pn"]] ?>"><br><br>
        Description:<br> <input type="text" name="propertydes" value="<?php echo $_SESSION['propertyaddress' . $data["pn"]] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

<?php
/**
 * If form is submitted as post method, update property method is called.
 * Property ID is passed as parameter in the update property method.
 * Property ID $data['pn'] is passed from PropertyController class.
 * 'pn' is array of different property ID.
 */
$propertyName =  $_SESSION['propertyname' . $data['pn']];
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $propertyID = $_SESSION['propertyid' . $data['pn']];

    $property->updateProperty($propertyID, $propertyName);
}
