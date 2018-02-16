<?php

/**
 * Name:
 * Date:
 */
class Task {
    protected $name;
    protected $description;
    protected $dueDate;
    protected $type;
    protected $length;
    protected $reminder;
    protected $status;
    protected $picture;
    protected $userId;
    protected $applianceId;
    protected $id;




    public function addTask() {
        require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $task_name = (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        $task_des = (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';
        $task_due = (isset($_POST['taskDue'])) ? $_POST['taskDue'] : '';
        $task_length = (isset($_POST['taskLength'])) ? $_POST['taskLength'] : '';
        $task_reminder = (isset($_POST['taskReminder'])) ? $_POST['taskReminder'] : '';
        $task_complete_status = (isset($_POST['taskCompleteStatus'])) ? $_POST['taskCompleteStatus'] : '';
        $task_active_status = (isset($_POST['taskActiveStatus'])) ? $_POST['taskActiveStatus'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO task (task_name, task_description, task_due, task_length, task_reminder, task_complete_status, task_active_status)
                    VALUES ('$task_name', '$task_des', '$task_due', '$task_length', '$task_reminder', '$task_complete_status', '$task_active_status')";

        if($db_connection->query($sql_data) === true){
            echo "Successfully added your task!";
        } else{
            echo "We weren't able to add your task. Please try again.";
        }
    }

    public function updateTask() {

    }

    public function deleteTask() {

    }

}