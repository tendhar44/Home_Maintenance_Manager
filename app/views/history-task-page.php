
<div class="container" id="info">
    <div class="row">
        <div class="col">

            <h3>Task History</h3>
            <br>

            <?php 

            $historyList = $data['historyList'];
                // var_dump($historyList);

            $counter = 0;

            if ($historyList == null){
                echo '
                <div class="row">
                <div class="col-sm-12">
                <p>
                There is currently no task history 
                </p>
                </div>
                </div>
                ';

                return;
            }

            foreach ($historyList as $task){
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
                Complete by: &nbsp;
                <span style="font-weight:600">
                '
                . $task['user'] .
                '
                </span>
                </p>
                </div><!-- close row -->

                <div class="row">
                <p>
                Complete Date: &nbsp;
                <span style="font-weight:600">
                '
                . $task['completeDate'] .
                '
                </span>
                </p>
                </div><!-- close row -->

                <div class="row">
                <div class="col">
                <div class="btn-group float-left mt-2">
                <a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/taskcontroller/task/'. $task['id'] .'">
                <i class="fa fa-flag" aria-hidden="true"></i>Details</a>
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

        </div><!-- close col -->
    </div><!-- row -->
</div><!-- close container -->