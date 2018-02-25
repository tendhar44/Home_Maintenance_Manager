<?php
session_start();

// root link
DEFINE ("BASE_LINK", "/home_maintenance_manager/public/");


//if signed in, show 'header-signedin.php' other wise 'header.php'
if(isset($_SESSION['loggedin'])){
    require_once("../public/header-signedin.php");
}else{
    require_once("../public/header.php");
}

//include the user and property class and database
require_once('../app/models/user.php');
require_once('../app/models/property.php');
require_once('../app/models/appliance.php');
require_once('../app/models/task.php');
require_once('../app/databaseConnection.php');
require_once('../app/models/Validation.php');

//create new database connection object
$db_con = new DatabaseConnection();

//connect to database
$db = $db_con->db_connect();

$valid = new Validation($db);

//create new User object
$user = new User($db, $valid);
$property = new Property($db);
$appliance = new Appliance($db);
$task = new Task($db);
