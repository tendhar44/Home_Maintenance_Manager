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

//define variable and set to empty
$tname = "";
$tdes = "";

//validates the inputs
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../app/models/Validation.php");
    $valid = new Validation();

    $tname = $valid->checkInput($_POST["taskName"]);
    $tdes = $valid->checkInput($_POST["taskDes"]);

    require_once("../app/models/Task.php");

    $task = new Task($tname, $tdes);
    $task->addTask();

    echo "<h4>Your Input:</h4>";
    echo $task->getTaskName();
    $_POST["taskDes"];
    echo "<br>";
    echo $tdes;
    echo "<br>";
}

