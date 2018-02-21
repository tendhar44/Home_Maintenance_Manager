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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getReminder()
    {
        return $this->reminder;
    }

    /**
     * @param mixed $reminder
     */
    public function setReminder($reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * @return mixed
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * @param mixed $complete
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getApplianceId()
    {
        return $this->applianceId;
    }

    /**
     * @param mixed $applianceId
     */
    public function setApplianceId($applianceId)
    {
        $this->applianceId = $applianceId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getListOfTasks($applianceId) {
        $taskNameArray = array();
        $taskDesArray = array();
        $appIdArray = array();
        $taskIdArray = array();
        //$db_connection = $this->database;
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

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
                echo $_SESSION['taskname' . $i] = $taskNameArray[$i];
                "</a>";
                echo " <a href='/home_maintenance_manager/public/taskcontroller/update/" . $i . "'>+Update</a> ";
                echo " <a href='/home_maintenance_manager/public/taskcontroller/delete/" . $i . "'>+Delete</a>";
                echo "<br><br>";
            }
        }

        for($i = 0; $i < sizeof($taskDesArray); $i++) {
            $_SESSION['taskdescription' . $i] = $taskDesArray[$i];
        }

        for($i = 0; $i < sizeof($taskIdArray); $i++) {
            $_SESSION['taskid' . $i] = $taskIdArray[$i];
        }
    }


    public function addTask() {
        //require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        //$db_connection = $this->database;

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
    public function deleteTask() {

    }

}