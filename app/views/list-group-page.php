
<div class="container" id="info">
    <br><br>
    <h3>Group List</h3>
    <br>
    <a href="/home_maintenance_manager/public/groupcontroller/add/<?php echo$_SESSION['userid']; ?>">+ Add Group</a>
    <div id="list-property">
        <?php
        echo $_SESSION['outputCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->