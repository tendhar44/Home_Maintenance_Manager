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
            if (isset($_POST['addTask'])){
                $taskManagement->addTask();
            }
            if (isset($_POST['updtateTaskStatus'])){
                $taskManagement->updateCompleteStatus();
            }  
        }
        $taskList = $taskManagement->getListOfTasks($propertyNum, $applianceId); 
        $this->view("list-task-page", ["appId" => $applianceId, "proNum" => $propertyNum, "taskList" => $taskList]);
    }

    public function add($propertyNum = 0, $applianceId = 0) {
        $this->notSignedIn();
        $this->view("add-task-page", ["proNum" => $propertyNum, "appId" => $applianceId]);
    }

    public function history($userId = 0){        
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement(); 
        $taskHistoryList = $taskManagement->getTaskHistoryList();
        // var_dump($taskHistoryList);

        $this->view("history-task-page", ["userid" => $userId, "historyList" => $taskHistoryList]);
    }

    public function task($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();

        $_SESSION['taskDetailCotent'] = $taskManagement->getTasksById($taskNum);
        $this->view("single-task-page", ["tn" => $taskNum]);
    }

    public function update($taskNum = 0) {
        $this->notSignedIn();
        $taskManagement =  $this->model->getTaskManagement();  
        $images = $taskManagement->getImage($taskNum);
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskID = $_SESSION['task' . $taskNum]['id'];
            if (isset($_POST['addTask'])){
                $taskManagement->updateTask($taskID);
            }  
            if (isset($_POST['addImg'])){
                $taskManagement->addImage($taskID);
            }      
            if (isset($_POST['deleteImage'])){
                $taskManagement->deleteImage($taskID);
            }      
        }
        
        $this->view("update-task-page", ["tn" => $taskNum, "img" => $images]);
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
            if (isset($_POST['updtateTaskStatus'])){
                $taskManagement->updateCompleteStatus();
            }  
            if (isset($_POST['addTask'])){
                $taskManagement->addTask();
            }      
        }

        $associativeData = $this->model->getAssociatedData();
        $taskList = $taskManagement->listAllTask(); 
        $this->view("listAll-task-page", ["userid" => $userId, "dropDownData" => $associativeData, "taskList" => $taskList]);
    }

}
