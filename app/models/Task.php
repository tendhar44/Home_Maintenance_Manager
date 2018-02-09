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




    public function addTask(){
        require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $task_name= (isset($_POST['taskName'])) ? $_POST['taskName'] : '';
        $task_des= (isset($_POST['taskDes'])) ? $_POST['taskDes'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO task (task_name, task_des) VALUES ('$task_name', '$task_des')";

        if($db_connection->query($sql_data) === true){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql_data. " . $db_connection->error;
        }
    }

    public function updateTask(){

    }

    public function deleteTask(){

    }

}