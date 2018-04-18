<?php

/**
 * Name:
 * Date:
 */
class ApplianceController extends Controller {
    public function index ($propertyId = 0){
        $this->notSignedIn();
        $appManagement =  $this->model->getApplianceManagement();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $appManagement->addAppliance();
        }
        $_SESSION['outputCotent'] = $appManagement->getListOfAppliances($propertyId); 

        $this->view("list-appliance-page", ["proId" => $propertyId]);
    }

    public function add($propertyId = 0) {
        $this->notSignedIn();
        $this->view("add-appliance-page", ["proId" => $propertyId]);
    }

    public function update($propertyId = 0, $applianceID = 0) {
        $this->notSignedIn();
        $appManagement =  $this->model->getApplianceManagement(); 
        $images = $appManagement->getImage($applianceID);

        /**
        * If form is submitted as post method, update appliance method is called.
        * Appliance ID is passed as parameter in the update appliance method.
        */
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['addAppliance'])){
            $appManagement->updateAppliance($applianceID, $propertyId);
            }  
            if (isset($_POST['addImg'])){
                $appManagement->addImage($_SESSION['applianceId' . $applianceID]['id']);
            }      
            if (isset($_POST['deleteImage'])){
                $appManagement->deleteImage($_SESSION['applianceId' . $applianceID]['id']);
            }      
        }

        $this->view("update-appliance-page", ["pn" => $propertyId, "an" => $applianceID, "img" => $images]);
    }

    public function delete($applianceNum = 0) {
        $this->notSignedIn();
        $appManagement =  $this->model->getApplianceManagement();
        $this->view("delete-appliance-page", ["an" => $applianceNum]);

        $appManagement->deleteAppliance($applianceNum);
    }

}
