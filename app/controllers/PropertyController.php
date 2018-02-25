<?php

/**
 * Name:
 * Date:
 */
class PropertyController extends Controller {
    public function index ($userId = 0){
        $this->view("list-property-page", ["uId" => $userId]);
    }

    public function add($userId = 0) {
        $this->view("add-property-page", ["uId" => $userId]);
    }

    public function update($propertyNum = 0) {
        $this->view("update-property-page", ["pn" => $propertyNum]);
    }

    public function delete($propertyNum = 0) {
        $this->view("delete-property-page", ["pn" => $propertyNum]);
    }
}