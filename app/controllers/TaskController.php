<?php

/**
 * Name:
 * Date:
 */
class TaskController extends Controller {
    public function index($applianceId = 0, $propertyNum = 0) {
        $this->view("list-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function add($applianceId = 0, $propertyNum = 0) {
        $this->view("add-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function update($taskNum = 0) {
        $this->view("update-task-page", ["tn" => $taskNum]);
    }

    public function delete($taskNum = 0) {
        $this->view("delete-task-page", ["tn" => $taskNum]);
    }

}