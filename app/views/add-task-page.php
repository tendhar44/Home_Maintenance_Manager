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
?>

<div class="container">
    <h3>Create A Task</h3>
    <hr>
    <br>
    <form id="addTaskForm" action="/Home_Maintenance_Manager/public/taskcontroller/<?php echo $data['appId']; ?>" method="post">
        Task Name: <span class="reqAsk">*</span><br> <input type="text" name="taskName" required><br><br>
        <!--Task Due Date: <span class="reqAsk">*</span><br> <input type="date" name="taskDue" required><br><br>-->

        <!-- one time task = 0, and repeat task = 1 -->
        <!--Task Type: <span class="reqAsk">*</span><br> <input type="radio" name="repeattask" value="0" required>&nbsp One Time
        <br><input type="radio" name="repeattask" value="1" required>&nbsp Repeat<br><br>

        Task length(days):<br> <input type="number" name="taskLength" value="1"><br><br>
        Task Reminder Time:<br> <input type="time" name="taskReminder"><br><br>-->
        Description:<br> <textarea name="taskDes"></textarea><br><br>

        <!-- hidden inputs flags task to active and task completed to false -->
        <!--<input type="hidden" name="taskActiveStatus" value="1">
        <input type="hidden" name="taskCompleteStatus" value="0">-->
        <input type="hidden" name="appId" value="<?php echo $data['appId']; ?>">

        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>