<?php
require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifLoggedIn(BASE_LINK . 'homecontroller', $userSigned);
?>


<div class="container">

<!--<form action="/Home_Maintenance_Manager/public/confirmationcontroller/thankyou" method="post">
    Username:<br> <input type="text" name="taskName"><br><br>
    Password:<br> <input type="text" name="taskDes"><br><br>
    <input type="submit" value="Sign In">
</form>-->

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Sign In</h2>
                <p>Not a member? <a class="hmm-links" href='/home_maintenance_manager/public/usercontroller/signup'>Sign Up</a></p>
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
                    <input type="text" name="userName" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="text" name="passWord" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Sign In" class="btn btn-dark btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>

<div>
    <br><br><br><br>
    * = required
</div>

</div>

<?php
require_once("../app/models/Validation.php");
$valid = new Validation();

//define variable and set to empty
$username = "";
$password = "";

//validates the inputs
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $valid->checkInput($_POST["userName"]);
    $password = $valid->checkInput($_POST["passWord"]);
}
if(isset($_POST['submit'])) {
    $user->signInUser($username, $password);
    header('Location: /home_maintenance_manager/public');
}

?>