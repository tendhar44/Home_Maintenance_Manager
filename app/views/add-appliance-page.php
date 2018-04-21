
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



        <div class="form-group">
            <label class="control-label col-sm-4"> Appliance Name:<span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input class="form-control" type="text" name="applianceName">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-6" for="imageSelector[]">Select Image only (limited 1000 kb):</label>
            <div class="col-sm-12">
                <input class="form-control" id="browse" name="imgSelector[]" type="file" onchange="previewFiles()" accept="image/*">
                <div id="preview"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="hidden" name="propertyId" value="<?php echo $data['proId']; ?>">
                <input class="btn btn-secondary btn-md" type="submit" value="Submit">
                    
            <span class="reqAsk">&nbsp; *</span> = required
            </div>
        </div>


    </form>

</div>