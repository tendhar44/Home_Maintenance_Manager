
<div class="container" id="info">
    <a href="/home_maintenance_manager/public">Home</a>
    <br><br>
    <h3>Property List</h3>
    <br>
    <a href="/home_maintenance_manager/public/propertycontroller/add/<?php echo$_SESSION['userid']; ?>">+ Add Property</a>
    <div id="list-property">
        <?php
            echo $_SESSION['outputCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->