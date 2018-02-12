<?php
session_start();

//include the user class and database
include('../app/models/user.php');
include('../app/databaseConnection.php');

$db_con = new DatabaseConnection();

$db = $db_con->db_connect();

$user = new User($db);