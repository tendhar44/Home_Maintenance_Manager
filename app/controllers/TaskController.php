<?php

/**
 * Name:
 * Date:
 */
class TaskController extends Controller {
    public function index() {
        $this->view("list-task-page", []);
    }

    public function add() {
        $this->view("add-task-page", []);
    }

    public function update() {
        $this->view("update-task-page", []);
    }

    public function delete() {
        $this->view("delete-task-page", []);
    }

}