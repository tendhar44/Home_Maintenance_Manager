<script>

    function previewFiles(){
        // console.log("testing");
        var preview = document.querySelector('#preview');
        var filesSelector = document.querySelector('input[type=file]');
        var files  = filesSelector.files;

        //clearing the preview div so previous img dont show
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        // check if selected files are images, if not clear fileSelector Input value
        if(!checkSelectedFiles(files)){
            filesSelector.value = "";
            return;
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
            // files.forEach(readAndPreview); // files is not array, 'object'
        }

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
                var reader = new FileReader();
                reader.addEventListener("load", function () {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    image.className = "imgPreview";
                        // image.warpAll('<div class="imgPreview"></div>');
                        preview.appendChild( image );
                    }, false);
                reader.readAsDataURL(file);
            }
        }
    }

    function checkSelectedFiles(files){
        for (var i = 0; i < files.length; i ++){
            console.log(files[i].type);
            if(!isImage(files[i].type)){
                return failValidation("Selected Files has to be a image");
            }
        }
        return true;
    }

    function getExtension(filename) {
        var parts = filename.split('/');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'jpg':
            case 'gif':
            case 'bmp':
            case 'png':
            case 'jpeg':
            //etc
            return true;
        }
        return false;
    }

    function failValidation(msg){
        alert(msg);
        return false;
    }

</script>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

    <br><br>
    <h3>Create A Property</h3>
    <hr>
    <br>
    <form action="/Home_Maintenance_Manager/public/propertycontroller/<?php echo $data['uId']; ?>" method="post" enctype="multipart/form-data">
        Property Name:<span class="reqAsk">*</span><br> <input type="text" name="propertyname" required><br><br>
        Address:<br> <input type="text" name="address"><br><br>
        Description:<br> <input type="text" name="propertydes"><br><br>

        <input id="browse" type="file" onchange="previewFiles()" multiple accept="image/*">
        <div id="preview"></div

            <br><br>
            <input type="hidden" name="ownerid" value="<?php echo $data['uId']; ?>">
            <input type="submit" value="Submit">
        </form>

        <div>
            <br><br><br><br>
            <span class="reqAsk">*</span> = required
        </div>
    </div>

    <script>
        $(function() {
            $("#imgupload").on('change', function(){
            });
        });    
    </script>