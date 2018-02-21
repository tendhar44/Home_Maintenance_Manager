<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

echo $data["tn"];
?>

<div class="container">
    <form action="" method="post">
        Task Name: <input type="text" name="taskName" value="<?php echo $_SESSION['taskname' . $data["tn"]] ?>">
        Description: <input type="text" name="taskDes" value="<?php echo $_SESSION['taskdescription' . $data["tn"]] ?>">
        <input type="submit" value="Submit">
    </form>
</div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_SESSION['taskid' . $data['tn']];
    echo $taskID;
    $task->updateTask($taskID);
}
