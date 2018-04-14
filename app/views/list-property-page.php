
<div class="container" id="info">
    <br><br>
    <h3>Property List</h3>
    <br>
    <a href="/home_maintenance_manager/public/propertycontroller/add/<?php echo$_SESSION['userid']; ?>">+ Add Property</a>
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


        
        echo $_SESSION['outputCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->


<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>