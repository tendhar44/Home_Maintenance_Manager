<?php
require_once("../app/models/Validation.php");
require_once("../app/models/User.php");



$valid = new Validation();

//define variable and set to empty
$username = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";

//validates the inputs
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $valid->checkInput($_POST["userName"]);
    $firstname = $valid->checkInput($_POST["firstName"]);
    $lastname = $valid->checkInput($_POST["lastName"]);
    $email = $valid->checkInput($_POST["email"]);
    $password = $valid->checkInput($_POST["password"]);
}

                //check for any errors
                /*if(isset($error)){
                    foreach($error as $error){
                        echo '<p class="bg-danger">'.$error.'</p>';
                    }
                }
                //if action is joined show success message
                if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                    echo "<h2 class='bg-success'>Successfully signed up! Check email to activate your account.</h2>";
                }*/

echo "<h4>Your Input:</h4>";
echo $username;
echo "<br>";
echo $firstname;
echo "<br>";
echo $lastname;
echo "<br>";
echo $email;
echo "<br>";
echo $password;
echo "<br>";