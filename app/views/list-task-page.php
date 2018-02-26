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
    $task->addTask();
}
?>

<div class="container" id="info">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data["proNum"]] ?>">Appliance</a>
    <br><br>
    <h3>Task List</h3>
    <br>
    <a href="/home_maintenance_manager/public/taskcontroller/add/<?php echo $data['appId']; ?>">+ Add Task</a>
    <div id="list-property">
    <?php
        $applianceId = $data["appId"];
        $task->getListOfTasks($applianceId);
    ?>
    </div><!-- close list-property -->
</div><!-- close container -->