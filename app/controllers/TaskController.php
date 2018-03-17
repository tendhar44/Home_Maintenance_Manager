<?php

/**
 * Name:
 * Date:
 */
class TaskController extends Controller {

    
    public function index($applianceId = 0, $propertyNum = 0) {
        $this->notSignedIn();        

        $taskManagement = $this->model->getTaskManagement();
        $_SESSION['outputCotent'] = $taskManagement->getListOfTasks($applianceId); 
        $this->view("list-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function add($applianceId = 0, $propertyNum = 0) {
        $this->notSignedIn();

        $taskManagement =  $this->model->getTaskManagement();
        $this->view("add-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->taskManagement->addTask();
        }
    }

    public function update($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();
        $this->view("update-task-page", ["tn" => $taskNum]);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskID = $_SESSION['taskid' . $taskNum];
            $this->taskManagement->updateTask($taskID);
        }
    }

    public function delete($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();
        $this->view("delete-task-page", ["tn" => $taskNum]);
    }

    //list all task of user regardless of property
    public function listAll($userId = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();
        $this->view("listAll-task-page", ["tn" => $taskNum]);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskID = $_SESSION['taskid' . $taskNum];
            $this->taskManagement->updateTask($taskID);
        }
    }
}