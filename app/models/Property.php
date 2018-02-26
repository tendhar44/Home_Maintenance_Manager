<?php

/**
 * Name:
 * Date:
 */
class Property {
    private $database;
    private $valid;

    protected $id;
    protected $name;
    protected $description;
    protected $address;
    protected $picture;
    protected $ownerid;

    public function __construct($db, $valid) {
        $this->valid = $valid;
        $this->database = $db;
    }

    public function addProperty() {
        $db_connection = $this->database;

        $property_name = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $property_address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $user_id = (isset($_POST['ownerid'])) ? $_POST['ownerid'] : '';
        $property_des = (isset($_POST['propertydes'])) ? $_POST['propertydes'] : '';

        $pn = mysqli_real_escape_string($db_connection, $property_name);
        $add = mysqli_real_escape_string($db_connection, $property_address);
        $uid = mysqli_real_escape_string($db_connection, $user_id);
        $pd = mysqli_real_escape_string($db_connection, $property_des);

        if($this->valid->checkPropertyName($pn, $uid)) {
            $sql_data = "INSERT INTO properties (ownerid, propertyname, description, address) VALUES ('$uid', '$pn', '$pd', '$add')";

            if ($db_connection->query($sql_data) === true) {
                echo "Successfully added your property!";
            } else {
                echo "We weren't able to add your property. Please try again.";
            }
        }else {
            echo "The property name should be unique.";
        }
    }

    public function getListOfProperties($userid) {
        $this->ownerid = $userid;
        $pronamearray = array();
        $proaddressarray = array();
        $proidarray = array();
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT propertyid, propertyname, description, address FROM properties WHERE ownerid = '$userid'";

        $userData = $db_connection->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $proidarray[] = $row['propertyid'];
            $pronamearray[] = $row['propertyname'];
            $proaddressarray[] = $row['address'];
        }

        for($i = 0; $i < sizeof($pronamearray); $i++) {
            $_SESSION['propertyid' . $i] = $proidarray[$i];
            $_SESSION['propertyaddress' . $i] = $proaddressarray[$i];
            $_SESSION['propertyname' . $i] = $pronamearray[$i];

    //display list of properties that can be collapse and un-collapse.
    echo '
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $i .'" aria-expanded="true" aria-controls="collapseOne">-->
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $i .'" aria-expanded="false" aria-controls="collapseTwo">
                ' . $pronamearray[$i] . '             
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
                  Property ID#: 
                        '
                        . $proidarray[$i] .

                        '
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Address: 
                        '
                        . $proaddressarray[$i] .

                        '
                  </div><!-- close col-7 -->
                  
                  <br>
                        
                  <div class="row">
                  <div class="col-1">
                    <a href="/home_maintenance_manager/public/appliancecontroller/'. $proidarray[$i] .'"><button>
                        View Devices
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
                    <a href="/home_maintenance_manager/public/propertycontroller/update/'. $i .'"><button class="stand-bttn-size">
                        Update
                      </button></a>
                  </div> 
                      
                  <div class="col-1">    
                    <a href="/home_maintenance_manager/public/propertycontroller/delete/'. $i .'"><button class="stand-bttn-size">
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

    public function getProperty($name) {
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM properties WHERE propertyname = '$name'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateProperty($id, $originalProName) {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        //$db_connection = $this->database;

        //$appId = (isset($_POST['appId'])) ? $_POST['appId'] : '';
        $propertyName = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        /*$duedate = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $repeattask = (isset($_POST['repeattask'])) ? $_POST['repeattask'] : '';
        $repeatlength = (isset($_POST['taskLength'])) ? $_POST['taskLength'] : '';
        $firstreminderdate = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $complete = (isset($_POST['taskCompleteStatus'])) ? $_POST['taskCompleteStatus'] : '';*/

        $pn = mysqli_real_escape_string($db_connection, $propertyName);
        $add = mysqli_real_escape_string($db_connection, $address);
        $proNameFlag = false;

            //if name is altered, check if name is unique
            if($originalProName != $propertyName){
                //if name is unique, precede to update, if not don't update.
                if($this->valid->checkPropertyName($pn)) {
                    $proNameFlag = true;
                }
                //name wasn't altered, so precede to update.
            }else{
                $proNameFlag = true;
            }

            if($proNameFlag){
            // attempt insert query execution
            $sql_data = "UPDATE properties SET propertyname='$pn', address='$add' WHERE propertyid = '$id'";

            if ($db_connection->query($sql_data) === true) {
                $_SESSION[$propertyName] = $propertyName;
                echo "Successfully updated your property!";
            } else {
                echo "We weren't able to update your property. Please try again.";
            }
        }else {
            echo "The property name should be unique.";
        }
    }

    public function deleteProperty($id) {
        $db_connection = $this->database;

        // attempt insert query execution
        $sql_data = "DELETE FROM properties WHERE propertyid = '$id'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully deleted your property!";
        } else {
            echo "We weren't able to delete your property. Please try again.";
        }
    }
}