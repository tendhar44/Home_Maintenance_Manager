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

    public function update($applianceNum = 0) {
        $this->notSignedIn();
        $appManagement =  $this->model->getApplianceManagement();

        $this->view("update-appliance-page", ["an" => $applianceNum]);

        /**
        * If form is submitted as post method, update appliance method is called.
        * Appliance ID is passed as parameter in the update appliance method.
        * Appliance ID $data['an'] is passed from ApplianceController class.
        * 'an' is array of different appliance ID.
        */
        if($_SERVER["REQUEST_METHOD"] == "POST") {
        $applianceID = $_SESSION['applianceid' . $applianceNum];
        $applianceName = $_SESSION['appliancename' . $applianceNum];

        $appManagement->updateAppliance($applianceID, $applianceName);
        }
    }

    public function delete($applianceNum = 0) {
        $this->notSignedIn();
        $this->view("delete-appliance-page", ["an" => $applianceNum]);
    }

}