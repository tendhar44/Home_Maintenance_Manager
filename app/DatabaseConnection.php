<?php
/**
 * Name:
 * Date:
 */

require_once("config/config.php");

$db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$db_connection) {
    die("error connecting to database");
}