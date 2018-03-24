<?php

/**
 * Name:
 * Date:
 */
class TaskManagement {
    private $conn;
    private $valid;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
    }

    public function getTasksById($taskNum) {
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

        //attempt select query execution
        $sql_data = "SELECT taskid, taskname, description, applianceid, repeattask, duedate, complete, intervaldays, firstreminderdate, reminderinterval FROM tasks WHERE taskid = '$taskNum'";

        $userData = $this->conn->query($sql_data);

        ob_start();

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

        echo
            'Task ID: <span style="font-weight:600">' . $taskIdArray[0] . '</span><br>' .
            'Task Name: <span style="font-weight:600">' . $taskNameArray[0] . '</span><br>' .
            'Descriptions: <span style="font-weight:600">' . $taskDesArray[0] . '</span><br>' .
            'Appliance ID: <span style="font-weight:600">' . $appIdArray[0] . '</span><br>' .
            'Task Repeat: <span style="font-weight:600">' . $taskRepeatArray[0] . '</span><br>' .
            'Due Date: <span style="font-weight:600">' . $taskDueDateArray[0] . '</span><br>' .
            'Completion: <span style="font-weight:600">' . $taskCompleteArray[0] . '</span><br>' .
            'Task Interval Day: <span style="font-weight:600">' . $taskIntervalDayArray[0] . '</span><br>' .
            'Task Reminder Date: <span style="font-weight:600">' . $taskFirstReminderDateArray[0] . '</span><br>' .
            'Task Reminder Interval: <span style="font-weight:600">' . $taskReminderIntervalArray[0] . '</span><br>'
            ;

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    //get the propertyAppliance id from PropertyApplianceBridge table
    private function getPropertyApplianceID($proID, $appID){
        if ($appID == NULL || $proID == NULL){
            return NULL;
        }
        $stmt = "select propertyApplianceId from PropertyApplianceBridge where propertyId = '$proID' and applianceId = '$appID'";

        $result = $this->conn->query($stmt);
        if($result === FALSE || $result->num_rows != 1) { 
            return NULL;
        }
        $row = $result->fetch_assoc();
        // var_dump($row['propertyApplianceId']);
        return $row['propertyApplianceId'];
    }

    // get the propertyAppliance id from existing task
    private function getExistTaskPropAppID($taskID){
        if ($taskID == NULL){
            return NULL;
        }
        $stmt = "select propertyApplianceId from tasks where taskid = '$taskID'";

        $result = $this->conn->query($stmt);
        if($result === FALSE || $result->num_rows != 1) { 
            return NULL;
        }
        $row = $result->fetch_assoc();
        // var_dump($row['propertyApplianceId']);
        return $row['propertyApplianceId'];        
    }

    public function addTask() {
        $appId = (isset($_POST['appId'])) ? $_POST['appId'] : NULL;
        $proId = (isset($_POST['proId'])) ? $_POST['proId'] : NULL;
        $proAppID = (isset($_POST['proAppID'])) ? $_POST['proAppID'] : NULL;

        // var_dump($appId);
        // var_dump($proId);

        $taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : NULL;
        $description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : NULL;
        $userid = $_SESSION['userid'];
        $duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : NULL;
        $repeattask = (isset($_POST['repeatTask'])) ? $_POST['repeatTask'] : 0;
        $repeatlength = (isset($_POST['intervalDay'])) ? $_POST['intervalDay'] : 0;
        $reminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : NULL;
        $complete = (isset($_POST['taskComplete'])) ? $_POST['taskComplete'] : '';
        $reminderinterval = (isset($_POST['reminderInterval'])) ? $_POST['reminderInterval'] : NULL;

        // die($duedate);

        $tn = mysqli_real_escape_string($this->conn, $taskName);
        $des = mysqli_real_escape_string($this->conn, $description);

        if($this->valid->checkTaskName($taskName)){
            if ($proAppID == NULL){
                $proAppID = $this->getPropertyApplianceID($proId, $appId);   
            }
            if($proAppID == NULL){
                echo "Failed to retrive bridge id of property and appliance";
                return;
            }

            // attempt insert query execution
            $sql_data = "
                INSERT INTO tasks (propertyApplianceId, taskname, description, userid, repeattask, duedate, complete, intervaldays, reminderdate, reminderinterval ) 

                VALUES ('$proAppID', '$tn', '$des', '$userid', '$repeattask', '$duedate', '$complete', '$repeatlength', '$reminderdate', '$reminderinterval')";

            if($this->conn->query($sql_data) === true) {
                echo "Successfully added your task!";
            }else {
                echo "We weren't able to add your task. Please try again.";
                 // die(mysqli_error($this->conn));
            }

        }else{
            echo "The task name should be unique.";
        }
    }


    public function getTaskFromId($id) {
        //attempt select query execution
        $sql_data = "SELECT * FROM tasks WHERE taskid = '$id'";

        $userData = $this->conn->query($sql_data);

        return $userData->fetch_assoc();
    }

    //getting task name from database by task id
    private function getTaskName($taskId){
        if($taskId == NULL){
            return NULL;
        }
        $stmt = "SELECT taskname from tasks where taskid = '$taskId'";
        $result = $this->conn->query($stmt);
        if ($result->num_rows != 1) {
            return NULL;
        }
        $row = $result->fetch_assoc();
        var_dump($row['taskname']);
        return $row['taskname'];
    }

    public function updateTask($id) {
        $taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        $description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';

        $taskName = mysqli_real_escape_string($this->conn, $taskName);
        $description = mysqli_real_escape_string($this->conn, $description);

        $propAppId = $this->getExistTaskPropAppID($id);

        $orginalTaskName = $this->getTaskName($id);
        $flag = false;
        //if name is altered, check if name is unique
        if($orginalTaskName != $taskName){
            //if name is unique, precede to update, if not don't update.
            if(!$this->valid->checkTaskName($id, $propAppId)) {
                $flag = true;
            }
            //name wasn't altered, so precede to update.
        }

        if(flag){
            // attempt insert query execution
            $sql_data = "UPDATE tasks SET taskname='$taskName', description='$description' WHERE taskid = '$id'";

            if($this->conn->query($sql_data) === true) {
                echo "Successfully updated your task!";
            } else {
                echo "We weren't able to update your task. Please try again.";
            }
        }else{
          echo "Name is already in use";
        }
    }
    public function deleteTask($id) {
        // attempt insert query execution
        //$sql_data = "DELETE FROM tasks WHERE taskid = '$id'";
        $sql_data = "UPDATE tasks SET logDelete = '1' WHERE taskid = '$id'";

        if($this->conn->query($sql_data) === true) {
            echo "Successfully deleted your task!";
        } else {
            echo "We weren't able to delete your task. Please try again.";
        }
    }

    // get the list of task for an appliance
    public function getListOfTasks($proID, $appID) {
        $taskNameArray = array();
        $propertyApplianceIdArray = array();
        $taskDesArray = array();
        $taskIdArray = array();
        $taskRepeatArray = array();
        $taskDueDateArray = array();
        $taskCompleteArray = array();
        $taskIntervalDayArray = array();
        $taskReminderDateArray = array();
        $taskReminderIntervalArray = array();

        $proAppID = $this->getPropertyApplianceID($proID,$appID);

        //attempt select query execution
        $sql_data = "SELECT taskid, propertyApplianceId, taskname, description, repeatTask, duedate, complete, intervalDays, reminderdate, reminderinterval 
            FROM tasks 
            WHERE (propertyApplianceId = '$proAppID') and (logDelete IS NULL or logDelete = 0)";

        $result = $this->conn->query($sql_data);

        if($result === FALSE) { 
            echo "Failed to retrive tasks";
            return;
        }

        while ($row = $result->fetch_assoc()) {
            $taskIdArray[] = $row['taskid'];
            $propertyApplianceIdArray[] = $row['propertyApplianceId'];
            $taskNameArray[] = $row['taskname'];
            $taskDesArray[] = $row['description'];
            $taskRepeatArray[] = $row['repeatTask'];
            $taskDueDateArray[] = $row['duedate'];
            $taskCompleteArray[] = $row['complete'];
            $taskIntervalDayArray[] = $row['intervalDays'];
            $taskReminderDateArray[] = $row['reminderdate'];
            $taskReminderIntervalArray[] = $row['reminderinterval'];
        }

        ob_start();

        for($i = 0; $i < sizeof($taskNameArray); $i++) {
                $_SESSION['taskname' . $i] = $taskNameArray[$i];
                $_SESSION['propertyApplianceId' . $i] = $propertyApplianceIdArray[$i];
                $_SESSION['taskdescription' . $i] = $taskDesArray[$i];
                $_SESSION['taskid' . $i] = $taskIdArray[$i];
                $_SESSION['repeattask' . $i] = $taskRepeatArray[$i];
                $_SESSION['duedate' . $i] = $taskDueDateArray[$i];
                $_SESSION['complete' . $i] = $taskCompleteArray[$i];
                $_SESSION['intervaldays' . $i] = $taskIntervalDayArray[$i];
                $_SESSION['taskReminderDate' . $i] = $taskReminderDateArray[$i];
                $_SESSION['reminderinterval' . $i] = $taskReminderIntervalArray[$i];


    //display list of task that can be collapse and un-collapse.
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
                    . $taskReminderDateArray[$i] .
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
                    <a href="/home_maintenance_manager/public/taskcontroller/task/'. $taskIdArray[$i] .'"><button>
                        Details
                      </button></a>
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
                    <a href="/home_maintenance_manager/public/taskcontroller/update/'. $taskIdArray[$i] .'"><button class="stand-bttn-size">
                        Update
                      </button></a>
                  </div> 
                      
                  <div class="col-1">    
                    <a href="/home_maintenance_manager/public/taskcontroller/delete/'. $taskIdArray[$i] .'"><button class="stand-bttn-size">
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
          $output = ob_get_contents();
          ob_end_clean();

          return $output;
    }

    //display a list of all task pertain to login user
    public function listAllTask(){

        $taskNameArray = array();
        $propertyApplianceIdArray = array();
        $taskDesArray = array();
        $taskIdArray = array();
        $taskRepeatArray = array();
        $taskDueDateArray = array();
        $taskCompleteArray = array();
        $taskIntervalDayArray = array();
        $taskReminderDateArray = array();
        $taskReminderIntervalArray = array();

        $userid = $_SESSION['userid'];
        //attempt select query execution
        $stmt = "SELECT taskid, propertyApplianceId, taskname, description, repeatTask, duedate, complete, intervalDays, reminderdate, reminderinterval 
            FROM tasks 
            WHERE (userid = '$userid') and (logDelete IS NULL or logDelete = 0)";

        $result = $this->conn->query($stmt);

        if($result === FALSE) { 
            echo "Failed to retrive tasks";
            return;
        }

        while ($row = $result->fetch_assoc()) {
            $taskIdArray[] = $row['taskid'];
            $propertyApplianceIdArray[] = $row['propertyApplianceId'];
            $taskNameArray[] = $row['taskname'];
            $taskDesArray[] = $row['description'];
            $taskRepeatArray[] = $row['repeatTask'];
            $taskDueDateArray[] = $row['duedate'];
            $taskCompleteArray[] = $row['complete'];
            $taskIntervalDayArray[] = $row['intervalDays'];
            $taskReminderDateArray[] = $row['reminderdate'];
            $taskReminderIntervalArray[] = $row['reminderinterval'];
        }


        ob_start();

        for($i = 0; $i < sizeof($taskNameArray); $i++) {
                $_SESSION['taskname' . $i] = $taskNameArray[$i];
                $_SESSION['propertyApplianceId' . $i] = $propertyApplianceIdArray[$i];
                $_SESSION['taskdescription' . $i] = $taskDesArray[$i];
                $_SESSION['taskid' . $i] = $taskIdArray[$i];
                $_SESSION['repeattask' . $i] = $taskRepeatArray[$i];
                $_SESSION['duedate' . $i] = $taskDueDateArray[$i];
                $_SESSION['complete' . $i] = $taskCompleteArray[$i];
                $_SESSION['intervaldays' . $i] = $taskIntervalDayArray[$i];
                $_SESSION['taskReminderDate' . $i] = $taskReminderDateArray[$i];
                $_SESSION['reminderinterval' . $i] = $taskReminderIntervalArray[$i];


    //display list of task that can be collapse and un-collapse.
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
                    . $taskReminderDateArray[$i] .
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
                    <a href="/home_maintenance_manager/public/taskcontroller/task/'. $taskIdArray[$i] .'"><button>
                        Details
                      </button></a>
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
                    <a href="/home_maintenance_manager/public/taskcontroller/update/'. $taskIdArray[$i] .'"><button class="stand-bttn-size">
                        Update
                      </button></a>
                  </div> 
                      
                  <div class="col-1">    
                    <a href="/home_maintenance_manager/public/taskcontroller/delete/'. $taskIdArray[$i] .'"><button class="stand-bttn-size">
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
          $output = ob_get_contents();
          ob_end_clean();

          return $output;
    }
}