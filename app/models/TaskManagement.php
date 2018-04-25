<?php

require_once("EventHandler.php");

/**
 * Name:
 * Date:
 */
class TaskManagement {
    private $conn;
    private $valid;
    private $eHandler;
    private $imageType = 't';

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
        $this->eHandler = new EventHandler();
    }

    //change task complete status.
    //html need button name = 'completeStatus' with value 0/1 
    public function updateCompleteStatus(){
        $id = (isset($_POST['taskid'])) ? $_POST['taskid'] : NULL;
        $status = (isset($_POST['completeStatus'])) ? $_POST['completeStatus'] : 0;
        $sequenceNo=null;

            // attempt insert query execution
        $stmt = "UPDATE tasks SET complete='$status' WHERE taskid = '$id'";

        if($status == 1){
            $sequenceNo = $this->getTaskHistorySequenceNumber($id);
            if(!$this->createTaskHistory($id, $sequenceNo)){
                $this->eHandler->alertMsg('Fail to create task in History');
                return;
            }


            // if ($_SESSION['task'.$id]['repeatTask'] == 1){
            //     $newDueDate = new DateTime($_SESSION['task'.$id]['duedate']);

            //     date_add($newDueDate,date_interval_create_from_date_string($_SESSION['task'.$id]['intervaldays'] . ' days'));

            //     $newReminderDate = new DateTime($_SESSION['task'.$id]['reminderdate']);

            //     date_add($newReminderDate,date_interval_create_from_date_string($_SESSION['task'.$id]['intervaldays'] . ' days'));


            //     $stmt = "UPDATE tasks SET complete='$status', duedate = '$newDueDate', reminderdate = '$newReminderDate'  WHERE taskid = '$id'";
            // }

            // attempt insert query execution
            $stmt = "UPDATE tasks SET complete='$status' WHERE taskid = '$id'";

        }

        if($this->conn->query($stmt)) {
            $this->eHandler->alertMsg('Successfully update task complete status');
        }else{
            $this->deleteTaskHistory($id, $sequenceNo);
            $this->eHandler->alertMsg('Fail to update task complete status');
        }
    }

    // delete a task history by task id and sequence number
    public function deleteTaskHistory($id, $sequenceNo){
        $stmt = "DELETE FROM taskHistory WHERE taskid = '$id', AND taskSequence = '$sequenceNo'";
        $this->conn->query($stmt);
    }

    //get all the groupid that the login user is associated with
    private function getUersGroupId(){
        $userid = $_SESSION['userid'];
        if (isset($_SESSION['owner']) && $_SESSION['owner']){
            $stmt = "SELECT groupid FROM groups 
            WHERE groupOwnerId = '$userid' and logDelete != 1"; 
        }else{
            $stmt = "SELECT groupid FROM usergroupbridge 
            WHERE userid = '$userid'"; 
        }
        // var_dump($stmt);        
        $result = $this->conn->query($stmt);

        if($result === FALSE) {
            // $this->eHandler->alertMsg('Fail to retrive group id associated with user from database');
            return null;
        }

        $associatedGroupId = null;
        $counter = 0;
        //fetch and store the data in an array
        while ($row = $result->fetch_assoc()) {
            $associatedGroupId[$counter] = $row['groupid'];
            $counter++;
        }
        return $associatedGroupId;
    }

    private function getGroupMemberId($groupId){
        $stmt = "SELECT userId FROM usergroupbridge
        WHERE groupId = '$groupId'"; 

        // var_dump($stmt);
        $result = $this->conn->query($stmt);
        if($result){
            $counter = 0;
            $groupUserId = null;
            while ($row = $result->fetch_assoc()) {
                $groupUserId[$counter] = $row['userId'];
                $counter++;
            }
            // var_dump($groupUserId);
            return $groupUserId;
        }
        return null;
    }

    //get an array of task history list
    public function getTaskHistoryList(){
        $userid = $_SESSION['userid'];
        $associatedGroupId = $this->getUersGroupId();
        if($associatedGroupId == null){
            return;
        }
        $whereClause = '';
        foreach ($associatedGroupId as $id) {
            if($whereClause !== ''){
                $whereClause .= '\' or groupId = \'';
            }
            $whereClause .= $id;
        }

        $membersId = $this->getGroupMemberId($whereClause);

        if($membersId == null){
            return null;
        }

        if (isset($_SESSION['owner']) && $_SESSION['owner']){
            array_push($membersId, $_SESSION['userid']);
        }else {            
            array_push($membersId, $_SESSION['ownerid']);
        }

        if($membersId == null){
            return;
        }

        $whereClause = '';
        foreach ($membersId as $id) {
            if($whereClause !== ''){
                $whereClause .= '\' or th.userid = \'';
            }
            $whereClause .= $id;
        }
        // var_dump($whereClause);
        $taskHistoryList = null;
        $stmt = "SELECT th.taskId, th.taskSequence, th.userID, th.completeDate, t.taskName, t.description, u.userName
        FROM taskHistory th
        INNER JOIN tasks t ON th.taskId = t.taskId
        INNER JOIN users u ON t.userid = u.userid
        where th.userid = '$whereClause'";
        // var_dump($stmt);
        $result = $this->conn->query($stmt);

        if($result === false) {
            // $this->eHandler->alertMsg('Fail to retrive task history data from database');
            return;
        }

        $counter = 0;

        while ($row = $result->fetch_assoc()) {
                    //creating a session associate array for a task
            $taskHistoryList[$counter] = array(
                'id' => $row['taskId'],
                'name' => $row['taskName'],
                'user' => $row['userName'],
                'description' => $row['description'],
                'taskSequence' => $row['taskSequence'],
                'userid' => $row['userID'],
                'completeDate' => $row['completeDate']
            );
            $counter++;
        }
        // var_dump($taskHistoryList);
        return $taskHistoryList;
    }

    // create a task history for completed task
    public function createTaskHistory($id, $sequenceNo){
        $userid = $_SESSION['userid'];//get user id from logged in user session
        $date = date("Y-m-d");// get current date

        $stmt = "
        INSERT INTO taskHistory (taskId, taskSequence, userId, CompleteDate) 
        VALUES ('$id', '$sequenceNo', '$userid', '$date')
        ";

        if($this->conn->query($stmt) === true) {
            // echo "true";
            return true;
        }else {
            // echo "false";
            return false;
        }
    }

    //get a sequence number according to taskHistory by id previously completed
    public function getTaskHistorySequenceNumber($id){
        $stmt = "
        SELECT * FROM taskHistory where taskId = '$id'";
        $result = $this->conn->query($stmt);

        if (!$result){
            return 1;
        }

        return (mysqli_num_rows($result) + 1);// return result plus 1
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
        $sql_data = "SELECT taskid, propertyApplianceId, taskname, description, repeatTask, duedate, complete, intervalDays, reminderdate, reminderinterval FROM tasks WHERE taskid = '$taskNum'";
        $userData = $this->conn->query($sql_data);
        ob_start();
        while ($row = $userData->fetch_assoc()) {
            $taskIdArray[] = $row['taskid'];
            $taskNameArray[] = $row['taskname'];
            $taskDesArray[] = $row['description'];
            $appIdArray[] = $row['propertyApplianceId'];
            $taskRepeatArray[] = $row['repeatTask'];
            $taskDueDateArray[] = $row['duedate'];
            $taskCompleteArray[] = $row['complete'];
            $taskIntervalDayArray[] = $row['intervalDays'];
            $taskFirstReminderDateArray[] = $row['reminderdate'];
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
    //get the propertyAppliance id from propertyappliancebridge table
    private function getPropertyApplianceID($proID, $appID){
        if ($appID == NULL || $proID == NULL){
            return NULL;
        }
        $stmt = "select propertyApplianceId from propertyappliancebridge where propertyId = '$proID' and applianceId = '$appID'";
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

    // get the propertyAppliance id base on appliance id
    private function getTaskPropAppID($appID){
        if ($appID == NULL){
            return NULL;
        }
        $stmt = "select propertyApplianceId from propertyappliancebridge where applianceid = '$appID'";
        $result = $this->conn->query($stmt);
        if($result === FALSE || $result->num_rows != 1) {
            return NULL;
        }
        $row = $result->fetch_assoc();
        // var_dump($row['propertyApplianceId']);
        return $row['propertyApplianceId'];
    }



    // add a task to the database
    public function addTask() {
        $appId = (isset($_POST['appId'])) ? $_POST['appId'] : NULL;
        $proId = (isset($_POST['proId'])) ? $_POST['proId'] : NULL;
        //$proAppID = (isset($_POST['proAppID'])) ? $_POST['proAppID'] : NULL;
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

        $proAppID = $this->getTaskPropAppID($appId);

        $tn = mysqli_real_escape_string($this->conn, $taskName);
        $des = mysqli_real_escape_string($this->conn, $description);

        if ($proAppID == NULL){
            $proAppID = $this->getPropertyApplianceID($proId, $appId);
        }
        if($proAppID == NULL){
            $this->eHandler->alertMsg("Failed to retrive bridge id of property and appliance");
            return;
        }
        if($this->valid->checkTaskName($tn)){
            // attempt insert query execution
            $sql_data = "
            INSERT INTO tasks (propertyApplianceId, taskname, description, userid, repeattask, duedate, complete, intervaldays, reminderdate, reminderinterval) 
            VALUES ('$proAppID', '$tn', '$des', '$userid', '$repeattask', '$duedate', '$complete', '$repeatlength', '$reminderdate', '$reminderinterval')";
            if($this->conn->query($sql_data) === true) {
                $last_Insert_Id = $this->conn->insert_id;
                $this->addImage($last_Insert_Id);
                $link = '/Home_Maintenance_Manager/public/taskcontroller/'.$proId.'/'.$appId;
                $this->eHandler->alertMsgRedirect("Successfully added your task!", $link);
            }else {
                $this->eHandler->alertMsg("We weren't able to add your task. Please try again.");
                // die(mysqli_error($this->conn));
            }
        }else{
            $this->eHandler->alertMsg("The task name should be unique.");
        }
    }
    
    public function addImage($objectID){  
        if ($_FILES['imgSelector'] && $_FILES['imgSelector']['size'][0] != 0){                
            $file_ary = $this->eHandler->reArrayFiles($_FILES['imgSelector']);
            $this->eHandler->uploadImage($file_ary, $objectID, $this->imageType, $this->conn);
        }
    }

    public function deleteImage($imageId){
        if (isset($_POST['imgId'])){
            $this->eHandler->deleteImage($_POST['imgId'], $this->conn);
        }
    }
    
    public function getImage($id){
        return $this->eHandler->getImage($id, $this->imageType, $this->conn);
    }

    //get task information from a task id
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
        // var_dump($row['taskname']);
        return $row['taskname'];
    }

    //update TasK Information
    public function updateTask($id) {
        $appId = (isset($_POST['appId'])) ? $_POST['appId'] : NULL;
        $proId = (isset($_POST['proId'])) ? $_POST['proId'] : NULL;
        //$proAppID = (isset($_POST['proAppID'])) ? $_POST['proAppID'] : NULL;
        // var_dump($appId);
        // var_dump($proId);
        $taskName = (isset($_POST['taskName'])) ? $_POST['taskName'] : NULL;

        $description = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : NULL;
        $duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : NULL;
        $repeattask = (isset($_POST['repeatTask'])) ? $_POST['repeatTask'] : 0;
        $repeatlength = (isset($_POST['intervalDay'])) ? $_POST['intervalDay'] : 0;
        $reminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : NULL;
        $reminderinterval = (isset($_POST['reminderInterval'])) ? $_POST['reminderInterval'] : NULL;
        // die($duedate);

        $proAppID = $this->getTaskPropAppID($appId);

        $tn = mysqli_real_escape_string($this->conn, $taskName);
        $des = mysqli_real_escape_string($this->conn, $description);

        if ($proAppID == NULL){
            $proAppID = $this->getPropertyApplianceID($proId, $appId);
        }
        if($proAppID == NULL){
            $this->eHandler->alertMsg("Failed to retrive bridge id of property and appliance");
            return;
        }

        $orginalTaskName = $this->getTaskName($id);
        $flag = true;
        //if name is altered, check if name is unique
        if($orginalTaskName != $taskName){
            $flag = false;
            //if name unique, set flag to true to proceed to update
            if($this->valid->checkTaskName($id, $proAppID)) {
                $flag = true;
            }
            //name wasn't altered, so precede to update.
        }
        if($flag){
            // attempt insert query execution
            $sql_data = "
            UPDATE tasks set taskname = '$tn', description = '$des', repeattask = '$repeattask', duedate = '$duedate', intervaldays = '$repeatlength', reminderdate = '$reminderdate', reminderinterval = '$reminderinterval' 
            WHERE taskid = '$id'
            ";

            if($this->conn->query($sql_data) === true) {
                $_SESSION['task' . $id]['name'] = $tn;
                $_SESSION['task' . $id]['description'] = $des;
                $_SESSION['task' . $id]['repeatTask'] = $repeattask;
                $_SESSION['task' . $id]['duedate'] = $duedate;
                $_SESSION['task' . $id]['intervaldays'] = $repeatlength;
                $_SESSION['task' . $id]['reminderdate'] = $reminderdate;
                $_SESSION['task' . $id]['reminderinterval'] = $reminderinterval;

                $this->eHandler->alertMsg("Successfully update");

            } else {
                $this->eHandler->alertMsg("Update task Failed. Please try again.");
            }
        }else{
            $this->eHandler->alertMsg("Name is already in use");
        }
    }
    public function deleteTask($id) {
        // attempt insert query execution
        //$sql_data = "DELETE FROM tasks WHERE taskid = '$id'";
        $sql_data = "UPDATE tasks SET logDelete = '1' WHERE taskid = '$id'";
        if($this->conn->query($sql_data) === true) {
            $this->eHandler->alertMsg("Successfully deleted your task!");
        } else {
            $this->eHandler->alertMsg("We weren't able to delete your task. Please try again.");
        }
    }
    // get the list of task for an appliance
    public function getListOfTasks($proID, $appID) {
        $proAppID = $this->getPropertyApplianceID($proID,$appID);
        //attempt select query execution
        $sql_data = "SELECT p.propertyid, p.applianceid, t.taskid, t.propertyApplianceId, t.taskname, t.description, t.repeatTask, t.duedate, t.complete, t.intervalDays, t.reminderdate, t.reminderinterval 
        FROM tasks t
        INNER JOIN propertyappliancebridge p ON t.propertyApplianceId = p.propertyApplianceId
        WHERE (t.propertyApplianceId = '$proAppID') and (logDelete != 1)
        ORDER BY t.taskname ASC
        ";
        $result = $this->conn->query($sql_data);
        if($result === FALSE) {
            $this->eHandler->alertMsg("Failed to retrive tasks");
            return;
        }
        $counter = 0;
        $taskList = null;
        while ($row = $result->fetch_assoc()) {
            $taskImgs = $this->getImage($row['taskid']);
            //creating a session associate array for a task
            $_SESSION['task' . $row['taskid']] = array(
                'id' => $row['taskid'],
                'propertyId' => $row['propertyid'],
                'applianceId' => $row['applianceid'],
                'proAppId' => $row['propertyApplianceId'],
                'name' => $row['taskname'],
                'description' => $row['description'],
                'repeatTask' => $row['repeatTask'],
                'duedate' => $row['duedate'],
                'complete' => $row['complete'],
                'intervaldays' => $row['intervalDays'],
                'reminderdate' => $row['reminderdate'],
                'reminderinterval' => $row['reminderinterval'],
                'imgs' => $taskImgs
            );
            $taskList[$counter] = array(
                'id' => $row['taskid'],
                'propertyId' => $row['propertyid'],
                'applianceId' => $row['applianceid'],
                'proAppId' => $row['propertyApplianceId'],
                'name' => $row['taskname'],
                'description' => $row['description'],
                'repeatTask' => $row['repeatTask'],
                'duedate' => $row['duedate'],
                'complete' => $row['complete'],
                'intervaldays' => $row['intervalDays'],
                'reminderdate' => $row['reminderdate'],
                'reminderinterval' => $row['reminderinterval'],
                'imgs' => $taskImgs
            );
            $counter++;
        }
        return $taskList;
    }


    //display a list of all task pertain to login user
    public function listAllTask(){
        $userid = $_SESSION['userid'];

        if(isset($_SESSION['owner']) && $_SESSION['owner']){
            // echo "owner list all";

            $stmt = "SELECT pr.propertyName, a.applianceName, p.propertyId, p.applianceId, t.taskid, t.propertyApplianceId, t.taskname, t.description, t.repeatTask, t.duedate, t.complete, t.intervalDays, t.reminderdate, t.reminderinterval 
            FROM propertyappliancebridge p 
            INNER JOIN tasks t ON t.propertyApplianceId = p.propertyApplianceId
            INNER JOIN properties pr ON pr.propertyId = p.propertyId
            INNER JOIN appliances a ON a.applianceId = p.applianceId            
            WHERE t.userid = '$userid' and t.logDelete !=1 and t.complete != 1
            ORDER BY t.taskname ASC
            ";

        } else if(isset($_SESSION['manager']) && $_SESSION['manager']) {

            // echo "manager list all";

            $stmt = "SELECT pr.propertyName, a.applianceName, p.propertyId, p.applianceId, t.taskid, t.propertyApplianceId, t.taskname, t.description, t.repeatTask, t.duedate, t.complete, t.intervalDays, t.reminderdate, t.reminderinterval 
            FROM tasks t 
            INNER JOIN propertyappliancebridge p ON t.propertyApplianceId = p.propertyApplianceId
            INNER JOIN propertygroupbridge pg ON p.propertyId = pg.propertyId 
            INNER JOIN usergroupbridge ug ON pg.groupId = ug.groupId
            INNER JOIN properties pr ON pr.propertyId = p.propertyId
            INNER JOIN appliances a ON a.applianceId = p.applianceId            
            WHERE ug.userId = '$userid' and t.logDelete !=1 and t.complete != 1
            ORDER BY t.taskname ASC
            ";

        } else if(isset($_SESSION['limitedUser']) && $_SESSION['limitedUser']) {

            // echo "limited user list all";

            $stmt = "SELECT pr.propertyName, a.applianceName, p.propertyId, p.applianceId, t.taskid, t.propertyApplianceId, t.taskname, t.description, t.repeatTask, t.duedate, t.complete, t.intervalDays, t.reminderdate, t.reminderinterval 
            FROM tasks t 
            INNER JOIN propertyappliancebridge p ON t.propertyApplianceId = p.propertyApplianceId
            INNER JOIN propertygroupbridge pg ON p.propertyId = pg.propertyId 
            INNER JOIN usergroupbridge ug ON pg.groupId = ug.groupId
            INNER JOIN properties pr ON pr.propertyId = p.propertyId
            INNER JOIN appliances a ON a.applianceId = p.applianceId            
            WHERE ug.userId = '$userid' and t.logDelete !=1 and t.complete != 1
            ORDER BY t.taskname ASC
            ";
        }


        $result = $this->conn->query($stmt);
        if($result === FALSE) {
            $this->eHandler->alertMsg("Failed to retrive tasks");
            return;
        }
        $counter = 0;
        $taskList = null;
        while ($row = $result->fetch_assoc()) {

            $taskImgs = $this->getImage($row['taskid']);
            //creating a session associate array for a task
            $_SESSION['task' . $row['taskid']] = array(
                'id' => $row['taskid'],
                'propertyId' => $row['propertyId'],
                'applianceId' => $row['applianceId'],
                'propertyName' => $row['propertyName'],
                'applianceName' => $row['applianceName'],
                'proAppId' => $row['propertyApplianceId'],
                'name' => $row['taskname'],
                'description' => $row['description'],
                'repeatTask' => $row['repeatTask'],
                'duedate' => $row['duedate'],
                'complete' => $row['complete'],
                'intervaldays' => $row['intervalDays'],
                'reminderdate' => $row['reminderdate'],
                'reminderinterval' => $row['reminderinterval'],
                'imgs' => $taskImgs
            );

            $taskList[$counter] = array(
                'id' => $row['taskid'],
                'propertyId' => $row['propertyId'],
                'applianceId' => $row['applianceId'],
                'propertyName' => $row['propertyName'],
                'applianceName' => $row['applianceName'],
                'proAppId' => $row['propertyApplianceId'],
                'name' => $row['taskname'],
                'description' => $row['description'],
                'repeatTask' => $row['repeatTask'],
                'duedate' => $row['duedate'],
                'complete' => $row['complete'],
                'intervaldays' => $row['intervalDays'],
                'reminderdate' => $row['reminderdate'],
                'reminderinterval' => $row['reminderinterval'],
                'imgs' => $taskImgs
            );

            $counter++;
        }
        return $taskList;
    }

}