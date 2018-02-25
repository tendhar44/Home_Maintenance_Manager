<?php
/**
 * Name:
 * Date:
 */

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'public/usercontroller/signin', $userSigned);
?>

<div class="container">
    <form action="/Home_Maintenance_Manager/public/propertycontroller/<?php echo $data['uId']; ?>" method="post">
        Property Name: <input type="text" name="propertyname">
        Address: <input type="text" name="address">
        <input type="hidden" name="ownerid" value="<?php echo $data['uId']; ?>">
        <input type="submit" value="Submit">
    </form>
</div>