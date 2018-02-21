<?php

/**
 * Name:
 * Date:
 */
class Property {
    private $database;
    protected $name;
    protected $description;
    protected $address;
    protected $picture;

    public function __construct($db) {
        $this->database = $db;
    }

    public function getListOfProperties() {
        $pronamearray = array();
        $proaddressarray = array();
        $proidarray = array();
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM property";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $proidarray[] = $row['propertyid'];
            $pronamearray[] = $row['propertyname'];
            $proaddressarray[] = $row['address'];
        }

        for($i = 0; $i < sizeof($pronamearray); $i++) {
            $_SESSION['propertyid' . $i] = $proidarray[$i];
            echo "<a href='/home_maintenance_manager/public/appliancecontroller/" . $proidarray[$i] . "'>" . $_SESSION['propertyname' . $i] = $pronamearray[$i];  "</a>";
            echo " <a href='/home_maintenance_manager/public/propertycontroller/update/" . $i . "'>+Update</a> ";
            echo " <a href='/home_maintenance_manager/public/propertycontroller/delete/" . $i . "'>+Delete</a>";
            echo "<br><br>";
        }

        for($i = 0; $i < sizeof($proaddressarray); $i++) {
            $_SESSION['propertyaddress' . $i] = $proaddressarray[$i];
        }
    }

    public function getProperty($name) {
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM property WHERE propertyname = '$name'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function addProperty() {
        $propertyName = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';

        $sql_data = "INSERT INTO property (propertyname, address) VALUES ('$propertyName', '$address')";

        $db_connection = $this->database;

        if($db_connection->query($sql_data) === true) {
            echo "Successfully added your property!";
        } else {
            echo "We weren't able to add your property. Please try again.";
        }
    }

    public function updateProperty($id) {
        //require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        //$db_connection = $this->database;

        //$appId = $this->applianceId;
        //$taskName = $this->name;
        //$description = $this->description;

        //$appId = (isset($_POST['appId'])) ? $_POST['appId'] : '';
        $propertyName = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        /*$duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $repeattask = (isset($_POST['repeattask'])) ? $_POST['repeattask'] : '';
        $repeatlength = (isset($_POST['taskLength'])) ? $_POST['taskLength'] : '';
        $firstreminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $complete = (isset($_POST['taskCompleteStatus'])) ? $_POST['taskCompleteStatus'] : '';*/

        // attempt insert query execution
        $sql_data = "UPDATE property SET propertyname='$propertyName', address='$address' WHERE propertyid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully updated your property!";
        } else {
            echo "We weren't able to update your property. Please try again.";
        }
    }

    public function deleteProperty($id) {
        //$db_con = new DatabaseConnection();
        //$db_connection = $db_con->db_connect();

        $db_connection = $this->database;

        // attempt insert query execution
        $sql_data = "DELETE FROM property WHERE propertyid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully deleted your property!";
        } else {
            echo "We weren't able to delete your property. Please try again.";
        }
    }
}