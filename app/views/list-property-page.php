<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $property->addProperty();
}
?>

<div class="container" id="info">
    <a href="/home_maintenance_manager/public">Home</a>
    <br><br>
    <h3>Property List</h3>
    <br>
    <a href="/home_maintenance_manager/public/propertycontroller/add/<?php echo $userID = $data['uId']; ?>">+ Add Property</a>
    <div id="list-property">
        <?php
            $userID = $data['uId'];
            $property->getListOfProperties($userID);
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->