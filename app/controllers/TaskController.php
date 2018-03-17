<?php

/**
 * Name:
 * Date:
 */
class TaskController extends Controller {
    public function index($applianceId = 0, $propertyNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();
        $this->notSignedIn();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskManagement->addTask();
        }
        $_SESSION['outputCotent'] = $taskManagement->getListOfTasks($applianceId); 
        $this->view("list-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function add($applianceId = 0, $propertyNum = 0) {
        $this->notSignedIn();
        $this->view("add-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function update($taskNum = 0) {
        $this->notSignedIn();
        $this->view("update-task-page", ["tn" => $taskNum]);

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskID = $_SESSION['taskid' . $taskNum];
            $task->updateTask($taskID);
        }
    }

    public function delete($taskNum = 0) {
        $this->notSignedIn();
        $this->view("delete-task-page", ["tn" => $taskNum]);
    }

}