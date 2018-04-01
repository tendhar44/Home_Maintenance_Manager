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

        /**
        * If form is submitted as post method, update appliance method is called.
        * Appliance ID is passed as parameter in the update appliance method.
        */
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $appManagement->updateAppliance($applianceID, $propertyId);
        }

        $this->view("update-appliance-page", ["pn" => $propertyId, "an" => $applianceID]);
    }

    public function delete($applianceNum = 0) {
        $this->notSignedIn();
        $appManagement =  $this->model->getApplianceManagement();
        $this->view("delete-appliance-page", ["an" => $applianceNum]);

        $appManagement->deleteAppliance($applianceNum);
    }

}