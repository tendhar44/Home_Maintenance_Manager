<?php

/**
 * Name:
 * Date:
 */
class TaskController extends Controller {
    public function index($propertyNum = 0, $applianceId = 0) {
        $this->notSignedIn();

        $taskManagement =  $this->model->getTaskManagement();
        if($_SERVER["REQUEST_METHOD"] == "POST") {            
            $taskManagement->addTask();
        }
        $_SESSION['outputCotent'] = $taskManagement->getListOfTasks($propertyNum, $applianceId); 
        $this->view("list-task-page", ["appId" => $applianceId, "proNum" => $propertyNum]);
    }

    public function add($propertyNum = 0, $applianceId = 0) {
        $this->notSignedIn();
        $this->view("add-task-page", ["proNum" => $propertyNum, "appId" => $applianceId]);
    }

    public function task($taskNum = 0, $apppNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();

        $_SESSION['taskDetailCotent'] = $taskManagement->getTasksById($taskNum);
        $this->view("single-task-page", ["tn" => $taskNum, "aan" => $apppNum]);
    }

    public function update($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskID = $_SESSION['task' . $taskNum]['id'];
            $taskManagement->updateTask($taskID);
        }
        $this->view("update-task-page", ["tn" => $taskNum]);
    }

    public function delete($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();
        $this->view("delete-task-page", ["tn" => $taskNum]);
        $taskManagement->deleteTask($taskNum);
    }

    //list all task of user regardless of property
    public function listAll($userId = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();

        // var_dump($_POST);

        if($_SERVER["REQUEST_METHOD"] == "POST") {            
            $taskManagement->addTask();
        }

        $associativeData = $this->model->getAssociatedData();
        $_SESSION['outputCotent'] = $taskManagement->listAllTask(); 
        $this->view("listAll-task-page", ["userid" => $userId, "dropDownData" => $associativeData]);
    }
}