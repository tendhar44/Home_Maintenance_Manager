
<div class="container" id="info">
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    >
    <a href="/home_maintenance_manager/public/appliancecontroller/<?php echo  $data["proNum"]?>">Appliance</a>
    <br><br>
    <h3>Task List</h3>
    <br>
    <a href="/home_maintenance_manager/public/taskcontroller/add/<?php echo $data["proNum"] ?>/<?php echo $data['appId']; ?>">+ Add Task</a>
    <div id="list-property">


                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                        <!-- The Close Button -->
                        <span class="close">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="imgEnlarge">

                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                        </div>

    <?php
        $applianceId = $data["appId"];
        echo $_SESSION['outputCotent'];
    ?>
    </div><!-- close list-property -->
</div><!-- close container -->

<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>