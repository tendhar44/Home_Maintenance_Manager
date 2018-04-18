
<div class="container" id="info">
    <
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>
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

        $counter = 0;

        if ($data['taskList'] == null){
            echo '
            <div class="row">
            <div class="col-sm-12">
            <p>
            There is currently no task available 
            </p>
            </div>
            </div>
            ';
            return;
        }

        foreach ($data['taskList'] as $task) {
            $counter++;

            echo '
            <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
            ' . $task['name'] . '             
            </a>
            </h5>
            </div><!-- close card-header -->
            <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">

            <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
            
            <div class="row">
            <p>
            Description: &nbsp;
            <span style="font-weight:600">
            '
            . $task['description'] .
            '
            </span>
            </p>
            </div><!-- close row -->

            <div class="row">
            <p>
            Due Date: &nbsp;
            <span style="font-weight:600">
            '
            . $task['duedate'] .
            '
            </span>
            </p>
            </div><!-- close row -->
            </div><!-- close col -->
            <div class="col-sm-6">';


            if($task['imgs'] != null){
                    // var_dump($data["img"]);

                foreach ($task['imgs'] as $image) {
                    echo '
                    <img id="myImg" class="imgPreview" src="/home_maintenance_manager/public/img/' . $image['name'] . '" alt="'. explode( '_', $image["name"] )[1] .'" width="150" height="150">
                    ';
                }
            }

            echo '
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
            </div><!-- close row -->


            <div class="row">
            <div class="col">
            <div class="btn-group float-left mt-2">
            <a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/taskcontroller/task/'. $task['id'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i>Details</a>
            </div>
            </div>
            <div class="col">
            <div class="btn-group float-md-right mt-2">

            <form action="#" method="post">
            <input type="hidden" name="taskid" value="'.$task['id'].'">
            <input type="hidden" name="completeStatus" value="1">
            <input type="submit" name="updtateTaskStatus" value="Complete" class="btn btn-md btn-secondary" aria-hidden="true">

            </form>

            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/update/'. $task['id'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i> Update</a>
            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/delete/'. $task['id'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i> Delete</a>
            </div>
            </div>

            </div><!-- close row -->



            
            </div><!-- close container fluid -->
            </div><!-- close card body -->
            </div><!-- close collapseOne -->
            </div><!-- close card -->

            ';

        }
    ?>

    </div><!-- close list-property -->
</div><!-- close container -->

<script src="/home_maintenance_manager/public/js/jqueryImg.js"></script>