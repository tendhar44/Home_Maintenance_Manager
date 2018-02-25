<?php
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
    //require_once("../app/models/Validation.php");
    //$valid = new Validation();

    $tname = $valid->checkInput($_POST["taskName"]);
    $tdes = $valid->checkInput($_POST["taskDes"]);

    //require_once("../app/models/Task.php");
    $task->addTask();
}
?>
<br>

<div class="container" id="info">
    <h3>Appliance List</h3>
    <br>
    <a href="/home_maintenance_manager/public/taskcontroller/add/<?php echo $data['appId']; ?>">+ Add Task</a>
    <div id="list-property">
    <?php
        $applianceId = $data["appId"];
        $task->getListOfTasks($applianceId);
    ?>
    </div><!-- close list-property -->
</div><!-- close container -->