
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $data["proId"] ?>">Appliance</a>

    <br><br>
    <h3>Create An Appliance</h3>
    <hr>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        Appliance Name:<span class="reqAsk">*</span><br> <input type="text" name="applianceName"><br><br>

        Select Image only (limited 1000 kb):<br>
        <input id="browse" name="imgSelector[]" type="file" onchange="previewFiles()" accept="image/*">
        <div id="preview"></div>

        <br>
        <br>
        <input type="hidden" name="propertyId" value="<?php echo $data['proId']; ?>">
        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>