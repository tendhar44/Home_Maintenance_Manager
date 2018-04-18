
<div class="container" id="info">
    <
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
    <br><br>
    <h3>Appliance List</h3>
    <br>
    <a href="/home_maintenance_manager/public/appliancecontroller/add/<?php echo $data['proId']; ?>">+ Add Appliance</a>
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
            $propertyId = $data["proId"];
            echo $_SESSION['outputCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->

<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>