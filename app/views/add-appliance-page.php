<?php
/**
 * Name:
 * Date:
 */

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);
?>

<div class="container">
    <form action="/Home_Maintenance_Manager/public/appliancecontroller/<?php echo $data['proId']; ?>" method="post">
        Appliance Name: <input type="text" name="applianceName">
        Model: <input type="text" name="applianceModel">
        <input type="hidden" name="propertyId" value="<?php echo $data['proId']; ?>">
        <input type="submit" value="Submit">
    </form>
</div>