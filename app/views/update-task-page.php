

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data["tn"]] ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['applianceid' . $data["tn"]] ?>">Task</a>
    <br><br>
    <form action="" method="post">
        Task Name:<br> <input type="text" name="taskName" value="<?php echo $_SESSION['taskname' . $data["tn"]] ?>"><br><br>
        Description:<br> <input type="text" name="taskDes" value="<?php echo $_SESSION['taskdescription' . $data["tn"]] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

