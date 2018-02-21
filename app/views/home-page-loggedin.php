<?php
require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h4>Home Maintenance Manager</h4>
            <hr>
            <p>Click on "View Properties" or "Create a Property" to get started.</p>

            <p>
                <ul>
                    <li>Once you create a property, you can add appliances to that property.</li>
                    <li>Then you can assign task to each of your appliances.</li>
                    <li>We'll send you a reminder to your email, when task is almost due.</li>
                </ul>
            </p>
            <br>
            <div class="col-xs-6 col-md-6">
                <h4><a class="btn btn-dark btn-block btn-lg" href='/home_maintenance_manager/public/propertycontroller'>View Properties</a></h4>
                <h4><a class="btn btn-dark btn-block btn-lg" href='/home_maintenance_manager/public/propertycontroller/add'>Create a Property</a></h4>
            </div>
        </div>
        <div class="col-md-6">
            <img src="../../public/img/pic1.jpg" alt="picture of appliances">
        </div>
    </div>

</div>
