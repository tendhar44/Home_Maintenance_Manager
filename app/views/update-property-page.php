
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">

    <div class="row">
        <div class="col">

            <a href="/home_maintenance_manager/public">Home</a>
            >
            <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

            <br><br>
            <h3>Update Property</h3>
            <hr>
            <br>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form action="#" method="post">
                Property Name:<br> <input type="text" name="propertyname" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['name'] ?>"><br><br>
                Address:<br> <input type="text" name="address" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['address'] ?>"><br><br>
                Description:<br> <input type="text" name="propertydes" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['description'] ?>"><br><br>
                <div class="form-group"> 
                    <button type="submit" name="addTask" value="AddTask" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

        <div class="col-auto">

            <?php 

            if($data["img"] != null){
                
                foreach ($data["img"] as $image) {


                    echo '

                    <img id="myImg" src="/home_maintenance_manager/public/image' . $image['name'] . '" alt="'. explode( '_', $image )[1] .'" width="200" height="200">

                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                    <!-- The Close Button -->
                    <span class="close">&times;</span>

                    <!-- Modal Content (The Image) -->
                    <img class="modal-content" id="enlargeImg">

                    <!-- Modal Caption (Image Text) -->
                    <div id="caption"></div>
                    </div>


                    ';
                }
            }


            ?>

            <label>
             Add Image
         </label>
         <form action="#" method="post">

            <input id="browse"  name="imgSelector[]" type="file" onchange="previewFiles()" multiple accept="image/*" disabled >

            <div id="preview"></div>

            <div class="form-group"> 
                <button type="submit" name="addTask" value="AddTask" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>

</div>

<script src="/home_maintenance_manager/public/js/enlargeImg.js" type="text/javascript"></script>