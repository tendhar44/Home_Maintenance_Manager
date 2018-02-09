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

    public function update() {
        $this->view("update-property-page", []);
    }

    public function delete() {
        $this->view("delete-property-page", []);
    }
}