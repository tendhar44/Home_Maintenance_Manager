

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $data["proId"] ?>">Appliance</a>

    <br><br>
    <h3>Create An Appliance</h3>
    <hr>
    <br>
    <form action="/Home_Maintenance_Manager/public/appliancecontroller/<?php echo $data['proId']; ?>" method="post">
        Appliance Name:<span class="reqAsk">*</span><br> <input type="text" name="applianceName"><br><br>
        Model:<br> <input type="text" name="applianceModel"><br><br>
        <input type="hidden" name="propertyId" value="<?php echo $data['proId']; ?>">
        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>