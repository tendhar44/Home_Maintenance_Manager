

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
        Task Name:<br> <input type="text" name="taskName" value="<?php echo $_SESSION['task' . $data["tn"]]['name'] ?>"><br><br>
        Description:<br> <input type="text" name="taskDes" value="<?php echo $_SESSION['task' . $data["tn"]]['description'] ?>"><br><br>

        <input type="hidden" name="propAppId" value="<?php echo "$propAppId"; ?>">
        <input type="submit" value="Submit">
    </form>
</div>

