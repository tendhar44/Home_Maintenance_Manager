<?php
session_start();

//if signed in, show 'header-signedin.php' other wise 'header.php'
if(isset($_SESSION['email_address'])){
    require_once("../public/header-signedin.php");
}else{
    require_once("../public/header.php");
}

//include the user class and database
include('../app/models/user.php');
include('../app/databaseConnection.php');

//create new database connection object
$db_con = new DatabaseConnection();

//connect to database
$db = $db_con->db_connect();

//create new User object
$user = new User($db);