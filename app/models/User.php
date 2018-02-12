<?php

/**
 * Name:
 * Date:
 */
class User {
    private $database;

    protected $userName;
    protected $passWord;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $type;

    public function __construct($database) {
        $this->database = $database;
    }

    public function isSignedIn() {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }
    }

    public function addUser() {

    }

    public function updateUser() {

    }

    public function deleteUser() {

    }

    public function signInUser() {

    }

    public function signOutUser() {

    }

    public function signUpUser() {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $user_name = (isset($_POST['userName'])) ? $_POST['userName'] : '';
        $first_name = (isset($_POST['firstName'])) ? $_POST['firstName'] : '';
        $last_name = (isset($_POST['lastName'])) ? $_POST['lastName'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO user (user_name, first_name, last_name, email) VALUES ('$user_name', '$first_name', '$last_name', '$email')";

        if($db_connection->query($sql_data) === true){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql_data. " . $db_connection->error;
        }
    }
}