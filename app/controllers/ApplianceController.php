<?php

/**
 * Name:
 * Date:
 */
class ApplianceController extends Controller {
    public function index (){
        $this->view("list-appliance-page", []);
    }

    public function add() {
        $this->view("add-appliance-page", []);
    }

    public function update() {
        $this->view("update-appliance-page", []);
    }

    public function delete() {
        $this->view("delete-appliance-page", []);
    }

}