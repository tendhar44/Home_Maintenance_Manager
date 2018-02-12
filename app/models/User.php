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
        require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();

        $user_name= (isset($_POST['userName'])) ? $_POST['userName'] : '';
        $pass_word= (isset($_POST['passWord'])) ? $_POST['passWord'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO user (user_name, password) VALUES ('$user_name', '$pass_word')";

        if($db_connection->query($sql_data) === true){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql_data. " . $db_connection->error;
        }
    }

    public function getUser($username){

    }

    public function updateUser() {

    }

    public function deleteUser() {

    }

    public function isValidUsername($username){
        $valid = new Validation();

        $userName = $valid->checkInput($username]);
        if (strlen($userName) < 3) return false;
        if (strlen($userName) > 17) return false;
        if (!ctype_alnum($userName)) return false;
        return true;
    }

    public function signInUser($username,$password) {
        if (!$this->isValidUsername($username)) return false;
        if (strlen($password) < 3) return false;

        $row = $this->getUser($username);

        if($this->password_verify($password,$row['password']) == 1){

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['memberID'] = $row['memberID'];
            return true;
        }

    }

    public function signOutUser() {
        session_destroy();
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