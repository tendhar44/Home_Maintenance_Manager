
<script src="/home_maintenance_manager/public/js/imageValidationAndPreview.js" type="text/javascript"></script>

<div class="container">
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo $data["proNum"] ?> ">Appliance</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $data["proNum"] ?>/<?php echo $data["appId"] ?>">Task</a>
    <br><br>

    <h3>Create A Task</h3>
    <hr>
    <br>


    <form id="addTaskForm" action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-sm-4" for="taskName">Task Name: <span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input class="form-control" name="taskName" id="taskName" placeholder="Enter Task Name" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="taskDue">Task Due Date: <span class="reqAsk">*</span></label>
            <div class="col-sm-12">
                <input type="date" class="form-control" name="taskDue" id="taskDue" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Repeat Task:</label>
            <div class="col-sm-12">
                <input type="radio" name="repeatTask" value="1">&nbsp; Yes &nbsp; &nbsp;
                <input type="radio" name="repeatTask" value="0" checked="checked">&nbsp; No
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="intervalDay">Interval Days:</label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="intervalDay" id="intervalDay">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="taskReminder">Reminder Date: </label>
            <div class="col-sm-12">
                <input type="date" class="form-control" name="taskReminder" id="taskReminder">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="reminderInterval">Reminder Interval Days:</label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="reminderInterval" id="reminderInterval">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="taskDes">Description:</label>
            <div class="col-sm-12">
                <textarea name="taskDes" class="form-control" id="taskDes"></textarea>
                <input id="browse" name="imgSelector[]" type="file" onchange="previewFiles()" accept="image/*">
                <div id="preview"></div>
            </div>
        </div>


        <div class="form-group">
            <br>
            <label class="control-label col-sm-4" for="imageSelector[]">Select Image only (limited 1000 kb):</label>
            <div class="col-sm-12">

            </div>
        </div>

        <input type="hidden" name="taskComplete" value="0">
        <input type="hidden" name="appId" value="<?php echo $data['appId']; ?>">
        <input type="hidden" name="proId" value="<?php echo $data['proNum']; ?>">

        <div class="form-group"> 
            <button type="submit" name="addTask" value="submit" class="btn btn-default">Submit</button>

            <span class="reqAsk">&nbsp; *</span> = required
        </div>
        <div>
        </div>
    </div>
</form> 

</div>