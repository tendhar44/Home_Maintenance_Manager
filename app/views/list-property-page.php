<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

require_once("../app/models/property.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $property->addProperty();
}
?>

<h3>List of Properties</h3>
<br>
<a href="/home_maintenance_manager/public/propertycontroller/add">+ Add Property</a>
<?php

echo "<br><br>";
$property->getListOfProperties();
