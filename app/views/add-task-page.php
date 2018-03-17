

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data["proNum"]] ?> ">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $data["appId"] ?>">Task</a>
    <br><br>

    <h3>Create A Task</h3>
    <hr>
    <br>
    <form id="addTaskForm" action="/Home_Maintenance_Manager/public/taskcontroller/<?php echo $data['appId']; ?>" method="post">
        Task Name: <span class="reqAsk">*</span><br> <input type="text" name="taskName" required><br><br>
        Task Due Date: <br> <input type="date" name="taskDue"><br><br>

        <!-- one time task = 0, and repeat task = 1 -->
        Repeat Task: <br> <input type="radio" name="repeatTask" value="1">&nbsp Yes
        <br><input type="radio" name="repeatTask" value="0" checked="checked">&nbsp No<br><br>
        Interval Days:<br> <input type="number" name="intervalDay" value="1"><br><br>
        Task Reminder Date:<br> <input type="date" name="taskReminder"><br><br>
        Reminder Interval Days:<br> <input type="number" name="reminderInterval"><br><br>

        Description:<br> <textarea name="taskDes"></textarea><br><br>
        <!--<input type="hidden" name="taskActiveStatus" value="1">-->
        <input type="hidden" name="taskComplete" value="0">
        <input type="hidden" name="appId" value="<?php echo $data['appId']; ?>">
        <input type="hidden" name="userId" value="<?php echo $_SESSION['userid']; ?>">

        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>