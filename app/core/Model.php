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
require_once('../app/DatabaseConnection.php');
require_once('../app/models/Validation.php');
require_once('../app/models/Calendar.php');
require_once('../app/models/GroupManagement.php');

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
    private $groupManagement;

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
        $this->groupManagement = new GroupManagement($this->conn, $this->valid);
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
    public function getGroupManagement(){
        return $this->groupManagement;
    }

    public function getAssociatedData(){

        $userId = $_SESSION['userid'];
        if (isset($_SESSION['owner']) && $_SESSION['owner']){

            $stmt = "
            SELECT p.propertyName, a.applianceid, a.appliancename 
            FROM propertyappliancebridge pa 
            INNER JOIN properties p ON p.propertyId = pa.propertyId 
            INNER JOIN appliances a ON a.applianceid = pa.applianceid
            WHERE p.ownerId = '$userId' and p.logDelete != 1
            ";   
        } else if (isset($_SESSION['manager']) && $_SESSION['manager']){    
            $groupIds = $this->getUersGroupId();
            if($groupIds == null){
                return;
            }
            $whereClause = '';
            foreach ($groupIds as $id) {
                if($whereClause !== ''){
                    $whereClause .= '\' or groupId = \'';
                }
                $whereClause .= $id;
            }

            $propertiesId = $this->getGroupPropertyId($whereClause);
            if ($propertiesId == null){
                return null;
            }
            $whereClause = '';
            foreach ($propertiesId as $id) {
                if($whereClause !== ''){
                    $whereClause .= '\' or pa.propertyId = \'';
                }
                $whereClause .= $id;
            }


            $stmt = "
            SELECT p.propertyName, a.applianceid, a.appliancename 
            FROM propertyappliancebridge pa 
            INNER JOIN properties p ON p.propertyId = pa.propertyId 
            INNER JOIN appliances a ON a.applianceid = pa.applianceid
            WHERE p.logDelete != 1 and pa.propertyId = '$whereClause'
            ";   


        }else {
            return null;
        }

        $result = $this->conn->query($stmt);

        if(!$result){
            return null;
        }

        $associativeArray = [];

        while ($row = $result->fetch_assoc()) {
            // var_dump($row);
            $associativeArray[$row['propertyName']][$row['appliancename']] = $row['applianceid'];
        }

        // var_dump($associativeArray);
        return $associativeArray;
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

    private function getGroupPropertyId($groupId){
        $stmt = "SELECT propertyId FROM propertygroupbridge
        WHERE groupId = '$groupId'"; 

        // var_dump($stmt);
        $result = $this->conn->query($stmt);
        if($result){
            $counter = 0;
            $groupPropertyId = null;
            while ($row = $result->fetch_assoc()) {
                $groupPropertyId[$counter] = $row['propertyId'];
                $counter++;
            }
            // var_dump($groupPropertyId);
            return $groupPropertyId;
        }
        return null;
    }

}