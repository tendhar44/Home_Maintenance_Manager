
<div class="container" id="info">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    <br><br>
    <h3>Appliance List</h3>
    <br>
    <a href="/home_maintenance_manager/public/appliancecontroller/add/<?php echo $data['proId']; ?>">+ Add Appliance</a>
    <div id="list-property">
        <?php
            $propertyId = $data["proId"];
            echo $_SESSION['outputCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->