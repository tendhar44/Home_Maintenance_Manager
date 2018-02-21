<?php

/**
 * Name:
 * Date:
 */
class Appliance {
    private $database;
    protected $name;
    protected $model;
    protected $picture;

    public function __construct($db) {
        $this->database = $db;
    }

    public function addAppliance() {
        $appliance_name = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        $appliance_model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';
        $propertyId = (isset($_POST['propertyId'])) ? $_POST['propertyId'] : '';

        $sql_data = "INSERT INTO appliance (appliancename, model, propertyid) VALUES ('$appliance_name', '$appliance_model', '$propertyId')";

        $db_connection = $this->database;

        if($db_connection->query($sql_data) === true) {
            echo "Successfully added your appliance!";
        } else {
            echo "We weren't able to add your appliance. Please try again.";
        }
    }

    public function updateAppliance($id) {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $applianceName = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        $model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';

        // attempt insert query execution
        $sql_data = "UPDATE appliance SET appliancename='$applianceName', model='$model' WHERE applianceid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully updated your appliance!";
        } else {
            echo "We weren't able to update your appliance. Please try again.";
        }
    }

    public function deleteAppliance() {

    }

    public function getListOfAppliances($propertyId) {
        $appNameArray = array();
        $appModelArray = array();
        $propertyIdArray = array();
        $appIdArray = array();
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM appliance WHERE propertyid = '$propertyId'";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $appIdArray[] = $row['applianceid'];
            $appNameArray[] = $row['appliancename'];
            $appModelArray[] = $row['model'];
            $propertyIdArray[] = $row['propertyid'];
        }

        for($i = 0; $i < sizeof($appNameArray); $i++) {
            if($propertyIdArray[$i] = $propertyId) {
                echo "<a href='/home_maintenance_manager/public/taskcontroller/" . $appIdArray[$i] . "'>" . $_SESSION['appliancename' . $i] = $appNameArray[$i];
                "</a>";
                echo " <a href='/home_maintenance_manager/public/appliancecontroller/update/" . $i . "'>+Update</a> ";
                echo " <a href='/home_maintenance_manager/public/appliancecontroller/delete/" . $i . "'>+Delete</a>";
                echo "<br><br>";
            }
        }

        for($i = 0; $i < sizeof($appIdArray); $i++) {
            $_SESSION['applianceid' . $i] = $appIdArray[$i];
        }

        for($i = 0; $i < sizeof($appModelArray); $i++) {
            $_SESSION['appliancemodel' . $i] = $appModelArray[$i];
        }
    }
}