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



class Model {

    //create new database connection object
    private $database;
    //connect to database
    private $db_con;
    private $valid;
    //create new User object 

    private $accountManagement;
    private $propertyManagement;
    private $applianceManagement;
    private $taskManagement;

    public function __construct() {
        //create new database connection object
        $db_con = new DatabaseConnection();    
        //connect to database
        $db = $db_con->db_connect();
        $valid = new Validation($db);
        //create new User object
        $this->accountManagement = new AccountManagement($db, $valid);
        $this->propertyManagement = new PropertyManagement($db, $valid);
        $this->applianceManagement = new ApplianceManagement($db, $valid);
        $this->taskManagement = new TaskManagement($db, $valid);

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



}