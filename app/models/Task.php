<?php

/**
 * Name:
 * Date:
 */
class Task {
    private $database;
    private $valid;

    protected $name;
    protected $description;
    protected $dueDate;
    protected $type;
    protected $length;
    protected $reminder;
    protected $complete;
    protected $picture;
    protected $userId;
    protected $applianceId;
    protected $id;

    public function __construct($db, $valid) {
        $this->valid = $valid;
        $this->database = $db;
    }

    public function getListOfTasks($applianceId) {
        $taskNameArray = array();
        $taskDesArray = array();
        $appIdArray = array();
        $taskIdArray = array();
        $taskRepeatArray = array();
        $taskDueDateArray = array();
        $taskCompleteArray = array();
        $taskIntervalDayArray = array();
        $taskFirstReminderDateArray = array();
        $taskReminderIntervalArray = array();


        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT taskid, taskname, description, applianceid, repeattask, duedate, complete, intervaldays, firstreminderdate, reminderinterval FROM tasks WHERE applianceid = '$applianceId'";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $taskIdArray[] = $row['taskid'];
            $taskNameArray[] = $row['taskname'];
            $taskDesArray[] = $row['description'];
            $appIdArray[] = $row['applianceid'];
            $taskRepeatArray[] = $row['repeattask'];
            $taskDueDateArray[] = $row['duedate'];
            $taskCompleteArray[] = $row['complete'];
            $taskIntervalDayArray[] = $row['intervaldays'];
            $taskFirstReminderDateArray[] = $row['firstreminderdate'];
            $taskReminderIntervalArray[] = $row['reminderinterval'];
        }

        for($i = 0; $i < sizeof($taskNameArray); $i++) {
            if($appIdArray[$i] = $applianceId) {
                $_SESSION['taskname' . $i] = $taskNameArray[$i];
                $_SESSION['taskdescription' . $i] = $taskDesArray[$i];
                $_SESSION['taskid' . $i] = $taskIdArray[$i];
                $_SESSION['applianceid' . $i] = $appIdArray[$i];
                $_SESSION['repeattask' . $i] = $taskRepeatArray[$i];
                $_SESSION['duedate' . $i] = $taskDueDateArray[$i];
                $_SESSION['complete' . $i] = $taskCompleteArray[$i];
                $_SESSION['intervaldays' . $i] = $taskIntervalDayArray[$i];
                $_SESSION['firstreminderdate' . $i] = $taskFirstReminderDateArray[$i];
                $_SESSION['reminderinterval' . $i] = $taskReminderIntervalArray[$i];


    //display list of properties that can be collapse and un-collapse.
    echo '
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $i .'" aria-expanded="false" aria-controls="collapseTwo">
                ' . $taskNameArray[$i] . '             
                </a>
            </h5>
        </div><!-- close card-header -->
              
        <div id="collapseTwo'. $i .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
              <div class="container-fluid">

                  <div class="col-3">

                  </div><!-- close col-3 -->
                  
                  <div class="col-7">
                  Task ID#: 
                    <span style="font-weight:600">
                    '
                    . $taskIdArray[$i] .

                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Description: 
                    <span style="font-weight:600">
                    '
                    . $taskDesArray[$i] .

                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Repeat Task: 
                    <span style="font-weight:600">
                    '
                    . $taskRepeatArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Due Date: 
                    <span style="font-weight:600">
                    '
                    . $taskDueDateArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Complete: 
                    <span style="font-weight:600">
                    '
                    . $taskCompleteArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Interval Day: 
                    <span style="font-weight:600">
                    '
                    . $taskIntervalDayArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  First Reminder Date: 
                    <span style="font-weight:600">
                    '
                    . $taskFirstReminderDateArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Reminder Interval Days: 
                    <span style="font-weight:600">
                    '
                    . $taskReminderIntervalArray[$i] .
                    '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <br>
                        
                  <div class="row">
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>

                  <div class="col-1">
                    <a href="/home_maintenance_manager/public/taskcontroller/update/'. $i .'"><button class="stand-bttn-size">
                        Update
                      </button></a>
                  </div> 
                      
                  <div class="col-1">    
                    <a href="/home_maintenance_manager/public/taskcontroller/delete/'. $i .'"><button class="stand-bttn-size">
                        Delete
                    </button></a>
                  </div>

                  </div><!-- close col-6 -->
                  
                </div><!-- close container fluid -->
            </div><!-- close card body -->
        </div><!-- close collapseOne -->
    </div><!-- close card -->
    ';//end echo
            }
        }
    }


    public function addTask() {
        $db_connection = $this->database;

        $appId = (isset($_POST['appId'])) ? $_POST['appId'] : '';
        $taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        $description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';
        $userid = (isset($_POST['userId'])) ? $_POST['userId'] : '';
        $duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $repeattask = (isset($_POST['repeatTask'])) ? $_POST['repeatTask'] : '';
        $repeatlength = (isset($_POST['intervalDay'])) ? $_POST['intervalDay'] : '';
        $firstreminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $complete = (isset($_POST['taskComplete'])) ? $_POST['taskComplete'] : '';
        $reminderinterval = (isset($_POST['reminderInterval'])) ? $_POST['reminderInterval'] : '';

        $tn = mysqli_real_escape_string($db_connection, $taskName);
        $des = mysqli_real_escape_string($db_connection, $description);

        if($this->valid->checkTaskName($taskName)){

            // attempt insert query execution
            $sql_data = "INSERT INTO tasks (applianceid, taskname, description, userid, repeattask, duedate, complete, intervaldays, firstreminderdate, reminderinterval ) VALUES ('$appId', '$tn', '$des', '$userid', '$repeattask', '$duedate', '$complete', '$repeatlength', '$firstreminderdate', '$reminderinterval')";

            if($db_connection->query($sql_data) === true) {
                echo "Successfully added your task!";
            }else {
                echo "We weren't able to add your task. Please try again.";
            }

        }else{
            echo "The task name should be unique.";
        }
    }


    public function getTaskFromId($id) {
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM tasks WHERE taskid = '$id'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateTask($id) {
        $db_connection = $this->database;

        $taskName = $_POST['taskName'];
        $description = $_POST['taskDes'];

        // attempt insert query execution
        $sql_data = "UPDATE tasks SET taskname='$taskName', description='$description' WHERE taskid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully updated your task!";
        } else {
            echo "We weren't able to update your task. Please try again.";
        }

    }
    public function deleteTask($id) {
        $db_connection = $this->database;

        // attempt insert query execution
        $sql_data = "DELETE FROM tasks WHERE taskid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully deleted your task!";
        } else {
            echo "We weren't able to delete your task. Please try again.";
        }
    }

}