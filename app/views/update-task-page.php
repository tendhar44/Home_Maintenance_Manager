

<?php
    // var_dump($propID);
    // var_dump($appID);
?>
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>/<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">Task</a>
    <br><br>


    <div class="row">
        <div id="cssForm" class="col-sm-12 col-md-6">
            <form action="#" method="post">

                Task Name: <span class="reqAsk">*</span><br> <input type="text" name="taskName" required value="<?php echo $_SESSION['task' . $data["tn"]]['name'] ?>"><br><br>
                Task Due Date: <br> <input type="date" name="taskDue" value="<?php echo $_SESSION['task' . $data["tn"]]['duedate'] ?>" required><br><br>

                <!-- one time task = 0, and repeat task = 1 -->
                Repeat Task: <br> <input type="radio" name="repeatTask" value="1">&nbsp; Yes
                <br><input type="radio" name="repeatTask" value="0" checked="checked">&nbsp; No<br><br>
                Interval Days:<br> <input type="number" name="intervalDay" value="<?php echo $_SESSION['task' . $data["tn"]]['intervaldays'] ?>"><br><br>
                Task Reminder Date:<br> <input type="date" name="taskReminder" value="<?php echo $_SESSION['task' . $data["tn"]]['reminderdate'] ?>"><br><br>
                Reminder Interval Days:<br> <input type="number" name="reminderInterval" value="<?php echo $_SESSION['task' . $data["tn"]]['reminderinterval'] ?>"><br><br>

                Description:<br> <textarea name="taskDes"><?php echo $_SESSION['task' . $data["tn"]]['description'] ?></textarea><br><br>
                <input type="hidden" name="appId" value="<?php echo $_SESSION['task' . $data["tn"]]['applianceId'] ?>">
                <input type="hidden" name="proId" value="<?php echo $_SESSION['task' . $data["tn"]]['propertyId'] ?>">
                <input type="hidden" name="propAppId" value="<?php echo $_SESSION['task' . $data["tn"]]['proAppId'] ?>">
                <button class="btn btn-md btn-secondary" name="addTask" type="submit" value="addTask">Submit</button>

            </form>
        </div>


        <div class="col-sm-12 col-md-6">
            <form id="cssForm" action="#" method="post" enctype="multipart/form-data"> 
                
                <div class="form-group">
                    <label for="sel1">Select Image Alt:</label>
                    <select name="altSelector" class="form-control" id="sel1">
                        <option>Front</option>
                        <option>Side</option>
                        <option>Back</option>
                        <option>MISC</option>
                    </select>
                </div>

                <div class="form-group"> 
                    <label>Add Image:
                    </label>
                    <input class="form-control" id="browse"  name="imgSelector[]" type="file" onchange="previewFiles()" required accept="image/*">

                    <div id="preview"></div>
                </div>

                <div class="form-group"> 
                    <button type="submit" name="addImg" value="addImg" class="btn btn-default">Submit</button>
                </div>
            </form>



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

    <div class='row'>
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
    </div>
</div>


<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>