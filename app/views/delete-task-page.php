<?php

require_once('../app/config/config.php');
require_once('../app/functions.php');
$userSigned = $user->isSignedIn();

//if not logged in redirect to login page
ifNotLoggedIn(BASE_LINK . 'usercontroller/signin', $userSigned);

$taskID = $_SESSION['taskid' . $data['tn']];
$task->deleteTask($taskID);
echo "<br><br>";
?>

<div class="container" id="info">
<a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['applianceid' . $data['tn']]; ?>"><-- Back to Task List</a>
</div>