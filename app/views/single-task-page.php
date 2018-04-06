
<div class="container" id="info">
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>/<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">Task</a>
    <br><br>
    <h3>Task Information</h3>
    <br>
    <div id="list-property">
        <?php
        echo $_SESSION['taskDetailCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->