
    /*
        required the following tag in html file
        id can be change as needed

        <input id="browse" name="imgSelector" type="file" onchange="previewFiles()" multiple accept="image/*">
        <div id="preview"></div

    */

    function previewFiles(){
        // console.log("testing");
        var preview = document.querySelector('#preview');
        var filesSelector = document.querySelector('input[type=file]');
        var files  = filesSelector.files;
        console.log(files);

        //clearing the preview div so previous img dont show
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        // check if selected files type and size
        if(!checkSelectedFiles(files) || !checkSize(files)){
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

    function checkSize(files){
        for (var i = 0; i < files.length; i ++){
            // console.log(files[i].type);
            if((files[i].size > 500000)){
                return failValidation("Selected Files size can only be 500 KB or less");
            }
        }
        return true;
    }

    function checkSelectedFiles(files){
        for (var i = 0; i < files.length; i ++){
            // console.log(files[i].type);
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
