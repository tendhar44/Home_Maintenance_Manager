

<?php

    $propID;
    $appID;
    if(isset($_SESSION['propertyid' . $data["tn"]]['id'])){
        $propID = $_SESSION['propertyid' . $data["tn"]]['id'];
    }else{
        $propID = $_SESSION['task' . $data["tn"]]['propertyId']; 
    }

    if(isset($_SESSION['applianceid' . $data["tn"]]['id'])){
        $appID = $_SESSION['applianceid' . $data["tn"]]['id'];
    }else{
        $appID = $_SESSION['task' . $data["tn"]]['applianceId']; 
    }

?>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $propID ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $appID ?>">Task</a>
    <br><br>
    <form action="" method="post">
        Task Name:<br> <input type="text" name="taskName" value="<?php echo $_SESSION['task' . $data["tn"]]['name'] ?>"><br><br>
        Description:<br> <input type="text" name="taskDes" value="<?php echo $_SESSION['task' . $data["tn"]]['description'] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

