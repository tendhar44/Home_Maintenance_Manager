<?php

/**
 * Name:
 * Date:
 */
class PropertyManagement {
    private $conn;
    private $valid;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
    }

    public function addProperty() {
        $property_name = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $property_address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $user_id = (isset($_POST['ownerid'])) ? $_POST['ownerid'] : '';
        $property_des = (isset($_POST['propertydes'])) ? $_POST['propertydes'] : '';

        $pn = mysqli_real_escape_string($this->conn, $property_name);
        $add = mysqli_real_escape_string($this->conn, $property_address);
        $uid = mysqli_real_escape_string($this->conn, $user_id);
        $pd = mysqli_real_escape_string($this->conn, $property_des);

        if($this->valid->checkPropertyName($pn, $uid)) {
            $sql_data = "INSERT INTO properties (ownerid, propertyname, description, address) VALUES ('$uid', '$pn', '$pd', '$add')";

            if ($this->conn->query($sql_data) === true) {
                echo "Successfully added your property!";
            } else {
                echo "We weren't able to add your property. Please try again.";
            }
        }else {
            echo "The property name should be unique.";
        }
    }


    public function getProperty($name) {
        //attempt select query execution
        $sql_data = "SELECT * FROM properties WHERE propertyname = '$name'";

        $userData = $this->conn->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateProperty($id, $originalProName) {
        $propertyName = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $propertyDes = (isset($_POST['propertydes'])) ? $_POST['propertydes'] : '';

        $pn = mysqli_real_escape_string($this->conn, $propertyName);
        $add = mysqli_real_escape_string($this->conn, $address);
        $pd = mysqli_real_escape_string($this->conn, $propertyDes);
        $proNameFlag = false;

        //if name is altered, check if name is unique
        if($originalProName != $pn){
             //if name is unique, precede to update, if not don't update.
            if($this->valid->checkPropertyName($pn)) {
                $proNameFlag = true;
            }
            //name wasn't altered, so precede to update.
        }else {
            $proNameFlag = true;
        }

        //if flag is true, precede with update
        if($proNameFlag){
            // attempt insert query execution
            $sql_data = "UPDATE properties SET propertyname='$pn', address='$add', description='$pd' WHERE propertyid = '$id'";

            if ($this->conn->query($sql_data) === true) {
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
        // attempt insert query execution
        $sql_data = "DELETE FROM properties WHERE propertyid = '$id'";
        if($this->conn->query($sql_data) === true) {
            echo "Successfully deleted your property!";
        } else {
            echo "We weren't able to delete your property. Please try again.";
        }
    }



    public function getListOfProperties($userid) {
        $this->ownerid = $userid;
        $pronamearray = array();
        $proaddressarray = array();
        $proidarray = array();
        $prodesarray = array();

        //attempt select query execution
        $sql_data = "SELECT propertyid, propertyname, description, address FROM properties WHERE ownerid = '$userid'";

        $userData = $this->conn->query($sql_data);

        while ($row = $userData->fetch_assoc()) {
            $proidarray[] = $row['propertyid'];
            $pronamearray[] = $row['propertyname'];
            $proaddressarray[] = $row['address'];
            $prodesarray[] = $row['description'];
        }

        ob_start();

        for($i = 0; $i < sizeof($pronamearray); $i++) {
            $_SESSION['propertyid' . $i] = $proidarray[$i];
            $_SESSION['propertyaddress' . $i] = $proaddressarray[$i];
            $_SESSION['propertyname' . $i] = $pronamearray[$i];
            $_SESSION['propertydes' . $i] = $prodesarray[$i];

    //display list of properties that can be collapse and un-collapse.
    echo '
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $i .'" aria-expanded="true" aria-controls="collapseOne">-->
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $i .'" aria-expanded="false" aria-controls="collapseTwo">
                ' . $pronamearray[$i] . '             
                </span></a>
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
                    <span style="font-weight:600">
                        '
                        . $proidarray[$i] .

                        '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Address:
                    <span style="font-weight:600">
                        '
                        . $proaddressarray[$i] .

                        '
                    </span>
                  </div><!-- close col-7 -->
                  
                  <div class="col-7">
                  Description: 
                    <span style="font-weight:600">
                        '
                        . $prodesarray[$i] .

                        '
                    </span>
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
        
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

}