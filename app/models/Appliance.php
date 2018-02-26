<?php

/**
 * Name:
 * Date:
 */
class Appliance {
    private $database;
    private $valid;

    protected $name;
    protected $model;
    protected $picture;

    public function __construct($db, $valid) {
        $this->valid = $valid;
        $this->database = $db;
    }

    public function addAppliance() {
        $appliance_name = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        $appliance_model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';
        $propertyId = (isset($_POST['propertyId'])) ? $_POST['propertyId'] : '';


        if($this->valid->checkApplianceName($appliance_name, $propertyId)) {
            $sql_data = "INSERT INTO appliances (appliancename, model) VALUES ('$appliance_name', '$appliance_model')";
            $sql_data2 = "INSERT INTO propertyappliancebridge (propertyid, applianceid) VALUES ('$propertyId', LAST_INSERT_ID())";

            $db_connection = $this->database;

            if ($db_connection->query($sql_data) === true && $db_connection->query($sql_data2) === true) {
                echo "Successfully added your appliance!";
            } else {
                echo "We weren't able to add your appliance. Please try again.";
            }
        }else {
            echo "The appliance name should be unique.";
        }
    }

    public function updateAppliance($id, $originalAppName) {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $applianceName = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        $model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';
        $appNameFlag = false;

        //if name is altered, check if name is unique
        if($originalAppName != $applianceName){
            //if name is unique, precede to update, if not don't update.
            if($this->valid->checkApplianceName($applianceName)) {
                $appNameFlag = true;
            }
            //name wasn't altered, so precede to update.
        }else{
            $appNameFlag = true;
        }

        if($appNameFlag) {

            // attempt insert query execution
            $sql_data = "UPDATE appliances SET appliancename='$applianceName', model='$model' WHERE applianceid = '$id'";

            if ($db_connection->query($sql_data) === true) {
                echo "Successfully updated your appliance!";
            } else {
                echo "We weren't able to update your appliance. Please try again.";
            }
        }else {
            echo "The appliance name should be unique.";
        }
    }

    public function deleteAppliance($id) {
        $db_connection = $this->database;

        // attempt insert query execution
        $sql_data = "DELETE FROM appliances WHERE applianceid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully deleted your appliance!";
        } else {
            echo "We weren't able to delete your appliance. Please try again.";
        }
    }

    public function getListOfAppliances($propertyId) {
        $appNameArray = array();
        $appModelArray = array();
        $propertyIdArray = array();
        $appIdArray = array();
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT a.applianceid, a.appliancename, a.model, pa.propertyid FROM appliances a JOIN propertyappliancebridge pa ON a.applianceid = pa.applianceid WHERE pa.propertyid = '$propertyId'";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $appIdArray[] = $row['applianceid'];
            $appNameArray[] = $row['appliancename'];
            $appModelArray[] = $row['model'];
            $propertyIdArray[] = $row['propertyid'];
        }

        for ($i = 0; $i < sizeof($appNameArray); $i++) {
            if ($propertyIdArray[$i] = $propertyId) {
                $_SESSION['appliancename' . $i] = $appNameArray[$i];
                $_SESSION['appliancemodel' . $i] = $appModelArray[$i];
                $_SESSION['applianceid' . $i] = $appIdArray[$i];
                $_SESSION['propertyid' . $i] = $propertyIdArray[$i];

    //display list of properties that can be collapse and un-collapse.
    echo '
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $i .'" aria-expanded="true" aria-controls="collapseOne">-->
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $i .'" aria-expanded="false" aria-controls="collapseTwo">
                ' . $appNameArray[$i] . '             
                </a>
            </h5>
        </div><!-- close card-header -->
              
        <!--<div id="collapseOne'. $i .'" class="collapse show" aria-labelledby="headingOne" data-parent="#list-appliance">-->
        <div id="collapseTwo'. $i .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
              <div class="container-fluid">

                  <div class="col-3">

                  </div><!-- close col-3 -->
                  
                  <div class="col-7">
                  Appliance ID#: 
                        '
                    . $appIdArray[$i] .

                    '
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Model: 
                        '
                    . $appModelArray[$i] .

                    '
                  </div><!-- close col-7 -->
                  
                  <br>
                        
                  <div class="row">
                  <div class="col-1">
                    <a href="/home_maintenance_manager/public/taskcontroller/'. $appIdArray[$i] .'"><button>
                        View Task
                      </button></a>
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>
                  
                  <div class="col-1">
                  </div>

                  <div class="col-1">
                    <a href="/home_maintenance_manager/public/appliancecontroller/update/'. $i .'"><button class="stand-bttn-size">
                        Update
                      </button></a>
                  </div> 
                      
                  <div class="col-1">    
                    <a href="/home_maintenance_manager/public/appliancecontroller/delete/'. $i .'"><button class="stand-bttn-size">
                        Delete
                    </button></a>
                  </div>

                  </div><!-- close col-6 -->
                  
                </div><!-- close container fluid -->
            </div><!-- close card body -->
        </div><!-- close collapseOne -->
    </div><!-- close card -->
    ';//end echo

            }
        }
    }
}