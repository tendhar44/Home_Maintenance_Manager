<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

$propertyID = $_SESSION['propertyid' . $data['pn']];
$property->deleteProperty($propertyID);
echo "<br><br>";
?>

<div class="container" id="info">
<a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid']; ?>"><-- Back to Property List</a>
</div>