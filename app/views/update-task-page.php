

<?php
    // var_dump($propID);
    // var_dump($appID);
?>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>/<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">Task</a>
    <br><br>
    <form action="#" method="post">

        Task Name: <span class="reqAsk">*</span><br> <input type="text" name="taskName" required value="<?php echo $_SESSION['task' . $data["tn"]]['name'] ?>"><br><br>
        Task Due Date: <br> <input type="date" name="taskDue" value="<?php echo $_SESSION['task' . $data["tn"]]['duedate'] ?>" required><br><br>

        <!-- one time task = 0, and repeat task = 1 -->
        Repeat Task: <br> <input type="radio" name="repeatTask" value="1">&nbsp; Yes
        <br><input type="radio" name="repeatTask" value="0" checked="checked">&nbsp; No<br><br>
        Interval Days:<br> <input type="number" name="intervalDay" value="<?php echo $_SESSION['task' . $data["tn"]]['intervaldays'] ?>"><br><br>
        Task Reminder Date:<br> <input type="date" name="taskReminder" value="<?php echo $_SESSION['task' . $data["tn"]]['reminderdate'] ?>"><br><br>
        Reminder Interval Days:<br> <input type="number" name="reminderInterval" value="<?php echo $_SESSION['task' . $data["tn"]]['reminderinterval'] ?>"><br><br>

        Description:<br> <textarea name="taskDes"><?php echo $_SESSION['task' . $data["tn"]]['description'] ?></textarea><br><br>
        <input type="hidden" name="appId" value="<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">
        <input type="hidden" name="proId" value="<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">
        <input type="hidden" name="propAppId" value="<?php echo $_SESSION['task' . $data["tn"]]['proAppId'] ?>">
        <button class="btn btn-md btn-secondary" type="submit" value="Submit">Submit</button>

    </form>
</div>

