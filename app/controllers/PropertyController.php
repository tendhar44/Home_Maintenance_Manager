<?php

/**
 * Name:
 * Date:
 */
class PropertyController extends Controller {
    public function index ($userId = 0){
        
        $proManagement =  $this->model->getPropertyManagement();
        $this->notSignedIn();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $proManagement->addProperty();
        }
        $_SESSION['outputCotent'] = $proManagement->getListOfProperties($_SESSION['userid']); 
        $this->view("list-property-page", ["uId" => $userId]);
    }

    public function add($userId = 0) {
        $this->notSignedIn();
        $this->view("add-property-page", ["uId" => $userId]);
    }

    public function update($propertyNum = 0) {
        $this->notSignedIn();
        $this->view("update-property-page", ["pn" => $propertyNum]);

        /**
         * If form is submitted as post method, update property method is called.
         * Property ID is passed as parameter in the update property method.
         * Property ID $data['pn'] is passed from PropertyController class.
         * 'pn' is array of different property ID.
         */
        $propertyName =  $_SESSION['propertyname' . $propertyNum];

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $propertyID = $_SESSION['propertyid' . $propertyNum];
            $property->updateProperty($propertyID, $propertyName);
        }
    }

    public function delete($propertyNum = 0) {
        $this->notSignedIn();
        $this->view("delete-property-page", ["pn" => $propertyNum]);
    }
}