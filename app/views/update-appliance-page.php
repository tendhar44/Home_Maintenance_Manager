<?php

?>
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['applianceId' . $data["an"]]['propertyId'] ?>">Appliance</a>

    <br><br>
    <h3>Update Appliance</h3>
    <hr>
    <br>

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <form action="" method="post">
                Appliance Name:<br> <input type="text" name="applianceName" value="<?php echo $_SESSION['applianceId' . $data["an"]]['name'] ?>">
                <br><br>
                <button class="btn btn-md btn-secondary" name="addAppliance" type="submit" value="addAppliance">Submit</button>
            </form>
        </div>


        <div class="col-sm-12 col-md-8">
            <form action="#" method="post" enctype="multipart/form-data"> 

                <label>Add Image
                </label>
                <div class="form-group"> 
                    <input id="browse"  name="imgSelector[]" type="file" onchange="previewFiles()" required accept="image/*">

                    <div id="preview"></div>
                </div>

                <div class="form-group"> 
                    <button class="btn btn-md btn-secondary" type="submit" name="addImg" value="addImg" class="btn btn-default">Submit</button>
                </div>
            </form>


            <?php 

            if($data["img"] != null){
                // var_dump($data["img"]);

                foreach ($data["img"] as $image) {


                    echo '
                    <div class="img-wrap">

                    <img id="myImg" class="imgPreview deletable" data-buttonId="'.$image["id"].'" src="/home_maintenance_manager/public/img/' . $image["name"] . '" alt="'. explode( '_', $image["name"] )[1] .'" width="150" height="150">

                    
                    <form action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="imgId" value="'.$image["id"] .'">
                    <button id="delete'.$image["id"].'" type="submit" name="deleteImage" value="deleteImage" class="btn">x</button>
                    </form>

                    </div>


                    ';
                }
            }


            ?>
            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="imgEnlarge">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>

        </div>
    </div>


</div>

<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>