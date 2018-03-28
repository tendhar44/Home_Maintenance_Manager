<?php

?>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['propertyid' . $data["an"]]['id'] ?>">Appliance</a>

    <br><br>
    <h3>Update Appliance</h3>
    <hr>
    <br>
    <form action="" method="post">
        Appliance Name:<br> <input type="text" name="applianceName" value="<?php echo $_SESSION['applianceId' . $data["an"]]['name'] ?>">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</div>
