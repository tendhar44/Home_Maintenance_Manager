<?php

/**
 * Name:
 * Date:
 */
class PropertyController extends Controller {
    public function index (){
        $this->view("list-property-page", []);
    }

    public function add() {
        $this->view("add-property-page", []);
    }

    public function update($propertyNum = 0) {
        $this->view("update-property-page", ["pn" => $propertyNum]);
    }

    public function delete($propertyNum = 0) {
        $this->view("delete-property-page", ["pn" => $propertyNum]);
    }
}