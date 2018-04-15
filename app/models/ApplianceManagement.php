<?php

/**
 * Name:
 * Date:
 */
class ApplianceManagement {
    private $conn;
    private $valid;
    private $tasks;
    private $imageType = 'a'; 
    private $eHandler;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
        $this->eHandler = new EventHandler();
    }

    public function addAppliance() {

        $appliance_name = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        // $appliance_model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';
        $propertyId = (isset($_POST['propertyId'])) ? $_POST['propertyId'] : '';

        $an = mysqli_real_escape_string($this->conn, $appliance_name);
        // $mo = mysqli_real_escape_string($db_connection, $appliance_model);

        if($this->valid->checkApplianceName($an, $propertyId)) {
            // $sql_data = "INSERT INTO appliances (appliancename, model) VALUES ('$an', '$mo')";
            $sql_data = "INSERT INTO appliances (appliancename) VALUES ('$an')";
            $sql_data2 = "INSERT INTO propertyappliancebridge (propertyid, applianceid) VALUES ('$propertyId', LAST_INSERT_ID())";

            if ($this->conn->query($sql_data) === true){
                    $last_Insert_Id = $this->conn->insert_id;
                if ($this->conn->query($sql_data2) === true) {
                    $this->eHandler->alertMsg("Successfully added your appliance!");
                    $last_Insert_Id = $this->conn->insert_id;
                    $this->addImage($last_Insert_Id);
                }
            } else {
                $this->eHandler->alertMsg("We weren't able to add your appliance. Please try again.");
            }
        }else {
            $this->eHandler->alertMsg("The appliance name should be unique.");
        }
    }

    public function addImage($objectID){  
        if ($_FILES['imgSelector']){                
            $file_ary = $this->eHandler->reArrayFiles($_FILES['imgSelector']);
                // var_dump($file_ary);
            $this->eHandler->uploadImage($file_ary, $objectID, $this->imageType, $this->conn);
        }
    }

    public function deleteImage($imageId){
        if (isset($_POST['imgId'])){
            $this->eHandler->deleteImage($_POST['imgId'], $this->conn);
        }
    }

    //getting appliance name from database by appliance id
    private function getApplianceName($applianceId){
        if($applianceId == NULL){
            return NULL;
        }
        $stmt = "SELECT appliancename from appliances where applianceId = '$applianceId'";
        $result = $this->conn->query($stmt);
        if ($result->num_rows != 1) {
            return NULL;
        }
        $row = $result->fetch_assoc();
        // var_dump($row['appliancename']);
        return $row['appliancename'];
    }

    public function getImage($id){
        return $this->eHandler->getImage($id, $this->imageType, $this->conn);
    }


    public function updateAppliance($id, $propID) {
        $applianceName = (isset($_POST['applianceName'])) ? $_POST['applianceName'] : '';
        // $model = (isset($_POST['applianceModel'])) ? $_POST['applianceModel'] : '';

        $applianceName = mysqli_real_escape_string($this->conn, $applianceName);
        // $model = mysqli_real_escape_string($this->conn, $model);

        $originalAppName = $this->getApplianceName($id);
        $flag = false;
        //if name is altered, check if name is unique
        if($originalAppName != $applianceName){
            $flag = true;
            //if name is unique, precede to update, if not don't update.
            if(!$this->valid->checkApplianceName($id, $propID)) {
                $flag = false;
            }
        }
        
        if($flag) {
            // attempt insert query execution
            $sql_data = "UPDATE appliances SET appliancename='$applianceName' WHERE applianceid = '$id'";

            if ($this->conn->query($sql_data) === true) {
                $_SESSION['applianceId' . $id]['name'] = $applianceName;
                $this->eHandler->alertMsg("Successfully updated your appliance!");
            } else {
                $this->eHandler->alertMsg("We weren't able to update your appliance. Please try again.");
            }
        }else {
            $this->eHandler->alertMsg("The appliance name should be unique.");
        }
    }

    public function deleteAppliance($id) {
        // attempt insert query execution
        //$sql_data = "DELETE FROM appliances WHERE applianceid = '$id'";
        $sql_data = "UPDATE appliances SET logDelete='1' WHERE applianceid = '$id'";

        if($this->conn->query($sql_data) === true) {
            $this->eHandler->alertMsg("Successfully deleted your appliance!");
        } else {
            $this->eHandler->alertMsg("We weren't able to delete your appliance. Please try again.");
        }
    }

    public function getListOfAppliances($propertyId) {
        $appNameArray = array();
        $appModelArray = array();
        $propertyIdArray = array();
        $appIdArray = array();
        //attempt select query execution
        $sql_data = "SELECT a.applianceid, a.appliancename, pa.propertyid FROM appliances a JOIN propertyappliancebridge pa ON a.applianceid = pa.applianceid WHERE pa.propertyid = '$propertyId' AND (logDelete IS NULL or logDelete = 0)";

        $userData = $this->conn->query($sql_data);

        $counter = 0;
        ob_start();
        while ($row = $userData->fetch_assoc()) {
            $counter++;

            $_SESSION['applianceId' . $row['applianceid']] = 
            array (
              'id' => $row['applianceid'],
              'name' => $row['appliancename'],
            // $appModelArray[] = $row['model'];
              'propertyId' => $row['propertyid']
          );



    //display list of properties that can be collapse and un-collapse.
            echo '
            <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $counter .'" aria-expanded="true" aria-controls="collapseOne">-->
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
            ' . $row['appliancename'] . '
            </a>
            </h5>
            </div><!-- close card-header -->

            <!--<div id="collapseOne'. $counter .'" class="collapse show" aria-labelledby="headingOne" data-parent="#list-appliance">-->
            <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
            <div class="container-fluid">

            <div class="row">
            <div class="col-xs-12 col-sm-4">
            
            <div class="row">
            Appliance ID#: 
            <span style="font-weight:600">
            '
            . $row['applianceid'] .

            '
            </span>
            </div><!-- close row -->
            </div><!-- close col -->
            <div class="col-xs-12" col-sm-8>';

            $imgs = $this->getImage($row['applianceid']);

            if($imgs != null){
                    // var_dump($data["img"]);

                foreach ($imgs as $image) {

                    echo '

                    <img id="myImg" class="imgPreview" src="/home_maintenance_manager/public/img/' . $image['name'] . '" alt="'. explode( '_', $image["name"] )[1] .'" width="150" height="150">

                    ';
                }
            }

            echo '

            </div><!-- close col -->
            </div><!-- close row -->

            <div class="row">
            <div class="col">
            <div class="btn-group float-left mt-2">
            <a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/taskcontroller/'. $row['propertyid'] .'/'. $row['applianceid'].'">
            <i class="fa fa-flag" aria-hidden="true"></i>Details</a>
            </div>
            </div>
            <div class="col">
            <div class="btn-group float-md-right mt-2">

            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/appliancecontroller/update/'. $row['propertyid'] .'/'. $row['applianceid'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i> Update</a>
            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/appliancecontroller/delete/'. $row['applianceid'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i> Delete</a>
            </div>
            </div>

            </div><!-- close row -->


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