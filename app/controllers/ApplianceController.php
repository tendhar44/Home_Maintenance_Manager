<?php

/**
 * Name:
 * Date:
 */
class ApplianceController extends Controller {
    public function index ($propertyId = 0){
        $this->view("list-appliance-page", ["proId" => $propertyId]);
    }

    public function add($propertyId = 0) {
        $this->view("add-appliance-page", ["proId" => $propertyId]);
    }

    public function update($applianceNum = 0) {
        $this->view("update-appliance-page", ["an" => $applianceNum]);
    }

    public function delete($applianceNum = 0) {
        $this->view("delete-appliance-page", ["an" => $applianceNum]);
    }

}