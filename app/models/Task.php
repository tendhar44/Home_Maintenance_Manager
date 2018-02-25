<?php

/**
 * Name:
 * Date:
 */
class Task {
    private $database;

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

    public function __construct($db) {
        $this->database = $db;
    }

    public function getListOfTasks($applianceId) {
        $taskNameArray = array();
        $taskDesArray = array();
        $appIdArray = array();
        $taskIdArray = array();
        $db_connection = $this->database;
        //$db_con = new DatabaseConnection();
        //$db_connection = $db_con->db_connect();

        //attempt select query execution
        $sql_data = "SELECT * FROM task WHERE applianceid = '$applianceId'";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $taskIdArray[] = $row['taskid'];
            $taskNameArray[] = $row['taskname'];
            $taskDesArray[] = $row['description'];
            $appIdArray[] = $row['applianceid'];
        }

        for($i = 0; $i < sizeof($taskNameArray); $i++) {
            if($appIdArray[$i] = $applianceId) {
                $_SESSION['taskname' . $i] = $taskNameArray[$i];
                $_SESSION['taskdescription' . $i] = $taskDesArray[$i];
                $_SESSION['taskid' . $i] = $taskIdArray[$i];
                $_SESSION['applianceid' . $i] = $appIdArray[$i];

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
                        '
                    . $taskIdArray[$i] .

                    '
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Description: 
                        '
                    . $taskDesArray[$i] .

                    '
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

        for($i = 0; $i < sizeof($taskDesArray); $i++) {

        }

        for($i = 0; $i < sizeof($taskIdArray); $i++) {

        }
    }


    public function addTask() {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $appId = $this->applianceId;
        $taskName = $this->name;
        $description = $this->description;

        $appId = (isset($_POST['appId'])) ? $_POST['appId'] : '';
        $taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        $description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';
        /*$duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $repeattask = (isset($_POST['repeattask'])) ? $_POST['repeattask'] : '';
        $repeatlength = (isset($_POST['taskLength'])) ? $_POST['taskLength'] : '';
        $firstreminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $complete = (isset($_POST['taskCompleteStatus'])) ? $_POST['taskCompleteStatus'] : '';*/

        // attempt insert query execution
        $sql_data = "INSERT INTO task (taskname, description, applianceid) VALUES ('$taskName', '$description', '$appId')";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully added your task!";
        } else {
            echo "We weren't able to add your task. Please try again.";
        }
    }


    public function getTaskFromId($id) {
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM task WHERE taskid = '$id'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateTask($id) {
        //require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        //$db_connection = $this->database;

        //$appId = $this->applianceId;
        //$taskName = $this->name;
        //$description = $this->description;

        //$appId = (isset($_POST['appId'])) ? $_POST['appId'] : '';
        //$taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        //$description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';
        /*$duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $repeattask = (isset($_POST['repeattask'])) ? $_POST['repeattask'] : '';
        $repeatlength = (isset($_POST['taskLength'])) ? $_POST['taskLength'] : '';
        $firstreminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $complete = (isset($_POST['taskCompleteStatus'])) ? $_POST['taskCompleteStatus'] : '';*/

        $taskName = $_POST['taskName'];
        $description = $_POST['taskDes'];

        // attempt insert query execution
        $sql_data = "UPDATE task SET taskname='$taskName', description='$description' WHERE taskid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully updated your task!";
        } else {
            echo "We weren't able to update your task. Please try again.";
        }

    }
    public function deleteTask($id) {
        $db_connection = $this->database;

        // attempt insert query execution
        $sql_data = "DELETE FROM task WHERE taskid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully deleted your task!";
        } else {
            echo "We weren't able to delete your task. Please try again.";
        }
    }

}