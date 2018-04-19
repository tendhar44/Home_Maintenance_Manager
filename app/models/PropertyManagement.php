<?php
require_once("EventHandler.php");

/**
 * Name:
 * Date:
 */
class PropertyManagement {
    private $conn;
    private $valid;
    private $eHandler;
    private $imageType = 'p';

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
        $this->eHandler = new EventHandler();
    }

    public function addProperty() {
        $property_name = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : NULL;
        $property_address = (isset($_POST['address'])) ? $_POST['address'] : '';
        $user_id = (isset($_POST['ownerid'])) ? $_POST['ownerid'] : NULL;
        $property_des = (isset($_POST['propertydes'])) ? $_POST['propertydes'] : '';

        $pn = mysqli_real_escape_string($this->conn, $property_name);
        $add = mysqli_real_escape_string($this->conn, $property_address);
        $uid = mysqli_real_escape_string($this->conn, $user_id);
        $pd = mysqli_real_escape_string($this->conn, $property_des);

    // var_dump($_FILES['imgSelector']);

        if($this->valid->checkPropertyName($pn, $uid)) {
            $sql_data = "INSERT INTO properties (ownerid, propertyname, description, address) VALUES ('$uid', '$pn', '$pd', '$add')";

            if ($this->conn->query($sql_data) === true) {
                $last_Insert_Id = $this->conn->insert_id;
                $this->addImage($last_Insert_Id);
                $link = '/Home_Maintenance_Manager/public/propertycontroller/'.$user_id;
                $this->eHandler->alertMsgRedirect("Successfully added your property!", $link);
            } else {
                $this->eHandler->alertMsg("We weren't able to add your property. Please try again.");
            }
        }else {
            $this->eHandler->alertMsg("The property name should be unique.");
        }
    }

    public function addImage($objectID){  
        // var_dump($_FILES['imgSelector']);
        if ($_FILES['imgSelector'] && $_FILES['imgSelector']['size'][0] != 0){                
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

    public function getImage($id){
        return $this->eHandler->getImage($id, $this->imageType, $this->conn);
    }

    public function getProperty($id) {
        //attempt select query execution
        $sql_data = "SELECT propertyid, propertyname, description, address FROM properties WHERE propertyid = '$id'";

        $result = $this->conn->query($sql_data);

        if ($result){
            $property;
            $row = $result->fetch_assoc();

            $property = array (
                'id' => $row['propertyid'],
                'address' => $row['address'],
                'name' => $row['propertyname'],
                'description' => $row['description']
            );
            return $property;
        }
        return null;
    }

    public function updateProperty($id, $originalProName) {
        $propertyName = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : NULL;
        $address = (isset($_POST['address'])) ? $_POST['address'] : NULL;
        $propertyDes = (isset($_POST['propertydes'])) ? $_POST['propertydes'] : NULL;

        $pn = mysqli_real_escape_string($this->conn, $propertyName);
        $add = mysqli_real_escape_string($this->conn, $address);
        $pd = mysqli_real_escape_string($this->conn, $propertyDes);

        $flag = true;
        //if name is altered, check if name is unique
        if($originalProName != $pn){
            $flag = false;
             //if name is unique, precede to update, if not don't update.
            if($this->valid->checkPropertyName($pn)) {
                $flag = true;
            }
            //name wasn't altered, so precede to update.
        }

                //if flag is true, precede with update
        if($flag){
                    // attempt insert query execution
            $sql_data = "UPDATE properties SET propertyname='$pn', address='$add', description='$pd' WHERE propertyid = '$id'";

            if ($this->conn->query($sql_data) === true) {
                $_SESSION['propertyid' . $id]['name'] = $pn;
                $_SESSION['propertyid' . $id]['address'] = $add;
                $_SESSION['propertyid' . $id]['description'] = $pd;
                $this->eHandler->alertMsg("Successfully updated your property!");
            } else {
                $this->eHandler->alertMsg("We weren't able to update your property. Please try again.");
            }
        } else {
            $this->eHandler->alertMsg("The property name should be unique.");
        }
    }

    public function deleteProperty($id) {
        // attempt insert query execution
        //$sql_data = "DELETE FROM properties WHERE propertyid = '$id'";
        $sql_data = "UPDATE properties SET logDelete = '1' WHERE propertyid = '$id'";

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
        $sql_data = "SELECT propertyid, propertyname, description, address FROM properties WHERE ownerid = '$userid' AND logDelete != 1";

        $userData = $this->conn->query($sql_data);

        ob_start();
        $counter = 0;
        while ($row = $userData->fetch_assoc()) {
            $counter++;

      //creating a session for listed property
            $_SESSION['propertyid' . $row['propertyid']] = 
            array (
              'id' => $row['propertyid'],
              'address' => $row['address'],
              'name' => $row['propertyname'],
              'description' => $row['description']
          );

      // var_dump($_SESSION['propertyid' . $row['propertyid']]);

    //display list of properties that can be collapse and un-collapse.
            echo '
            <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
            <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $counter .'" aria-expanded="true" aria-controls="collapseOne">-->
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
            ' . $row['propertyname'] . '             
            </span></a>
            </h5>
            </div><!-- close card-header -->

            <!--<div id="collapseOne'. $counter .'" class="collapse show" aria-labelledby="headingOne" data-parent="#list-appliance">-->
            <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
            <div class="container-fluid">

            <div class="row">
            <div class="col-xs-12 col-sm-4">
            <div class="row">

            Property ID#: 
            <span style="font-weight:600">
            '
            . $row['propertyid'] .

            '
            </span>
            </div><!-- close row -->

            <div class="row">
            Address:
            <span style="font-weight:600">
            '
            . $row['address'] .

            '
            </span>
            </div><!-- close row -->

            <div class="row">
            Description: 
            <span style="font-weight:600">
            '
            . $row['description'] .

            '
            </span>
            </div><!-- close row -->
            </div><!-- close col -->
            <div class="col-xs-12" col-sm-8>
            <div class="row">';

            $imgs = $this->getImage($row['propertyid']);

            if($imgs != null){
                    // var_dump($data["img"]);

                foreach ($imgs as $image) {

                    echo '
                    <div class="img-wrap">
                    <img id="myImg" class="imgPreview" src="/home_maintenance_manager/public/img/' . $image['name'] . '" alt="'. explode( '_', $image["name"] )[1] .'" width="150" height="150">
                    <div class="caption text-center">
                    <p>'. $image["altText"] .'</p>
                    </div>
                    </div>

                    ';
                }
            }

            echo '

            </div><!-- close row -->
            </div><!-- close col -->
            </div><!-- close row -->
            
            <div class="row">
            <div class="col">
            <div class="btn-group float-left mt-2">
            <a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/appliancecontroller/'. $row['propertyid'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i>View Property Appliance</a>
            </div>
            </div>
            <div class="col">
            <div class="btn-group float-md-right mt-2">

            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/propertycontroller/update/'. $row['propertyid'] .'">
            <i class="fa fa-flag" aria-hidden="true"></i> Update</a>
            <a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/propertycontroller/delete/'. $row['propertyid'] .'">
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