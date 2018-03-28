

<?php

$propID = $_SESSION['task' . $data["tn"]]['propertyId']; 
$appID = $_SESSION['task' . $data["tn"]]['applianceId']; 
$propAppId = $_SESSION['task' . $data["tn"]]['proAppId']; 

    // var_dump($propID);
    // var_dump($appID);

?>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $propID ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $propID ?>/<?php echo $appID ?>">Task</a>
    <br><br>
    <form action="" method="post">

        Task Name: <span class="reqAsk">*</span><br> <input type="text" name="taskName" required value="<?php echo $_SESSION['task' . $data["tn"]]['name'] ?>"><br><br>
        Task Due Date: <br> <input type="date" name="taskDue" required><br><br>

        <!-- one time task = 0, and repeat task = 1 -->
        Repeat Task: <br> <input type="radio" name="repeatTask" value="1">&nbsp; Yes
        <br><input type="radio" name="repeatTask" value="0" checked="checked">&nbsp; No<br><br>
        Interval Days:<br> <input type="number" name="intervalDay" value="1"><br><br>
        Task Reminder Date:<br> <input type="date" name="taskReminder"><br><br>
        Reminder Interval Days:<br> <input type="number" name="reminderInterval"><br><br>

        Description:<br> <textarea name="taskDes"><?php echo $_SESSION['task' . $data["tn"]]['description'] ?></textarea><br><br>
        <input type="hidden" name="appId" value="<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">
        <input type="hidden" name="proId" value="<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">
        <input type="hidden" name="propAppId" value="<?php echo "$propAppId"; ?>">

        <input type="submit" value="Submit">

    </form>
</div>

