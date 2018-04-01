<?php

/**
 * Name:
 * Date:
 */


//include the user and property class and database
require_once('../app/models/AccountManagement.php');
require_once('../app/models/PropertyManagement.php');
require_once('../app/models/ApplianceManagement.php');
require_once('../app/models/TaskManagement.php');
require_once('../app/databaseConnection.php');
require_once('../app/models/Validation.php');
require_once('../app/models/Calendar.php');

class Model {

    //create new database connection object
    private $database;
    //connect to database
    private $conn;
    private $valid;
    //create new User object 

    private $accountManagement;
    private $propertyManagement;
    private $applianceManagement;
    private $taskManagement;
    private $calendar;

    public function __construct() {
        //create new database connection object
        $this->database = new DatabaseConnection();    
        //connect to database
        $this->conn = $this->database->db_connect();

        $this->valid = new Validation($this->conn);
        //create new User object
        $this->accountManagement = new AccountManagement($this->conn, $this->valid);
        $this->propertyManagement = new PropertyManagement($this->conn, $this->valid);
        $this->applianceManagement = new ApplianceManagement($this->conn, $this->valid);
        $this->taskManagement = new TaskManagement($this->conn, $this->valid);
        $this->calendar = new Calendar($this->conn, $this->valid);

    }

    public function getAccountManagement(){
      return $this->accountManagement;
    }
    public function getPropertyManagement(){
      return $this->propertyManagement;
    }
    public function getApplianceManagement(){
      return $this->applianceManagement;
    }
    public function getTaskManagement(){
      return $this->taskManagement;
    }
    public function getCalendar(){
        return $this->calendar;
    }


    public function getAssociatedData(){

        $userId = $_SESSION['userid'];

        $stmt = "
            SELECT p.propertyName, a.applianceid, a.appliancename 
            FROM propertyappliancebridge pa 
            INNER JOIN properties p ON p.propertyId = pa.propertyId 
            INNER JOIN appliances a ON a.applianceid = pa.applianceid
            WHERE p.ownerId = '$userId' and p.logDelete != 1
            ";

        $result = $this->conn->query($stmt);

        $associativeArray = [];

        while ($row = $result->fetch_assoc()) {
            // var_dump($row);
            $associativeArray[$row['propertyName']][$row['appliancename']] = $row['applianceid'];
        }

        // var_dump($associativeArray);
        return $associativeArray;
    }
}