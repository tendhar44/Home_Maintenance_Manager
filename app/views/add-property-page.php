
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

    <br><br>
    <h3>Create A Property</h3>
    <hr>
    <br>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-sm-4">Property Name:<span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input class="form-control" type="text" name="propertyname" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Address:<span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input class="form-control" type="text" name="address">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Description:<span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input class="form-control" type="text" name="propertydes">
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
                <input type="hidden" name="ownerid" value="<?php echo $data['uId']; ?>">
                <input class="btn btn-secondary btn-md" type="submit" value="Submit">
                <span class="reqAsk">&nbsp; *</span> = required
            </div>
        </div>

    </form>
</div>

<script>
$(function() {
    $("#imgupload").on('change', function(){
    });
});    
</script>