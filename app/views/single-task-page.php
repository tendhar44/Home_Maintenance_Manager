
<div class="container" id="info">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/taskcontroller/<?php echo $_SESSION['applianceid' . $data["aan"]] ?>">Task</a>
    <br><br>
    <h3>Task Information</h3>
    <br>
    <div id="list-property">
        <?php
        echo $_SESSION['taskDetailCotent'];
        ?>
    </div><!-- close list-property -->
</div><!-- close container -->