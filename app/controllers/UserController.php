<?php

/**
 * Name:
 * Date:
 */
class UserController extends Controller {
    public function index() {
        $this->view("list-user-page", []);
    }

    public function add() {
        $this->view("add-user-page", []);
    }

    public function update() {
        $this->view("update-user-page", []);
    }

    public function delete() {
        $this->view("delete-user-page", []);
    }

}