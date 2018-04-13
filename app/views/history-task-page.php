
<div class="container" id="info">
    <div class="row">
        <div class="col">

            <h3>Task List</h3>
            <br>

            <?php 

                $historyList = $data['historyList'];
                var_dump($historyList);

                $counter = 0;
                foreach ($historyList as $task){
                    $counter++;

        echo '

        <div class="card">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
        ' . $task['taskname'] . '             
        </a>
        </h5>
        </div><!-- close card-header -->

        <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="card-body">

        <div class="container-fluid">
        <div class="row">

        <p>
        Description: &nbsp;
        <span style="font-weight:600">
        '
        . $row['description'] .
        '
        </span>
        </p>
        </div><!-- close row -->

        <div class="row">
        <p>
        Due Date: &nbsp;
        <span style="font-weight:600">
        '
        . $row['duedate'] .
        '
        </span>
        </p>
        </div><!-- close row -->

        <div class="row">
        <div class="col">
            <div class="btn-group float-left mt-2">
                <a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/taskcontroller/task/'. $row['taskid'] .'">
                    <i class="fa fa-flag" aria-hidden="true"></i>Details</a>
            </div>
            </div>
            <div class="col">
            <div class="btn-group float-md-right mt-2">

                <form action="#" method="post">
                    <input type="hidden" name="taskid" value="'.$row['taskid'].'">
                    <input type="hidden" name="completeStatus" value="1">
                    <input type="submit" name="updtateTaskStatus" value="Complete" class="btn btn-md btn-secondary" aria-hidden="true">

                </form>

                <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/update/'. $row['taskid'] .'">
                    <i class="fa fa-flag" aria-hidden="true"></i> Update</a>
                <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/delete/'. $row['taskid'] .'">
                    <i class="fa fa-flag" aria-hidden="true"></i> Delete</a>
            </div>
            </div>

        </div><!-- close row -->

        </div><!-- close container fluid -->
        </div><!-- close card body -->
        </div><!-- close collapseOne -->
        </div><!-- close card -->
             
        ';
                };
            ?>

        </div><!-- close col -->
    </div><!-- row -->
</div><!-- close container -->