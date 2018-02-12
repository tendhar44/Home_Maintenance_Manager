<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifLoggedIn('../public/homecontroller', $userSigned);

?>

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Sign Up to Create a <br>Property Manager Account</h2>
                <p>Already a member? <a class="hmm-links" href='/home_maintenance_manager/public/usercontroller/signin'>Sign In</a></p>
                <hr>

                <?php
                /*require_once("../app/models/Validation.php");
                require_once("../app/models/User.php");

                $user = new User();
                $user->signUpUser();

                $valid = new Validation();

                //define variable and set to empty
                $tname = "";
                $tdes = "";

                //validates the inputs
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $tname = $valid->checkInput($_POST["taskName"]);
                    $tdes = $valid->checkInput($_POST["taskDes"]);
                }*/

                //check for any errors
                if(isset($error)){
                    foreach($error as $error){
                        echo '<p class="bg-danger">'.$error.'</p>';
                    }
                }
                //if action is joined show success message
                if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                    echo "<h2 class='bg-success'>Successfully signed up! Check email to activate your account.</h2>";
                }
                ?>

                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First Name" tabindex="2">
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last Name" tabindex="3">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-dark btn-block btn-lg" tabindex="8"></div>
                </div>
            </form>
        </div>
    </div>

    <div>
        <br><br><br><br><br><br>
        * = required
    </div>
</div>


