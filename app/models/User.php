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
        /*require_once("../app/DatabaseConnection.php");

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
        }*/
    }

    public function getUser($username){
        require_once("../app/DatabaseConnection.php");

        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();



        //attempt select query execution
        $sql_data = "SELECT * FROM user WHERE user_name = '$username'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();

    }

    public function updateUser() {

    }

    public function deleteUser() {

    }

    public function isValidUsername($username){
        require_once("../app/models/Validation.php");
        $valid = new Validation();

        $userName = $valid->checkInput($username);
        if (strlen($userName) < 3) return false;
        if (strlen($userName) > 17) return false;
        if (!ctype_alnum($userName)) return false;
        return true;
    }

    //turn the password into hash code
    public function passwordHash($password, $hashCode) {

    }

    public function signInUser($username,$password) {
        if(!$this->isValidUsername($username)) {
            return false;
        }
        if (strlen($password) < 3) {
            return false;
        }

        $row = $this->getUser($username);

        //if($this->passwordHash($password,$row['password']) == 1){
        if($username == $row['user_name'] && $password == $row['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['user_name'];
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['lastname'] = $row['last_name'];
            return true;
        }else {
            return false;
        }
        //}

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
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO user (user_name, password, email, first_name, last_name) VALUES ('$user_name', '$password', '$email', '$first_name', '$last_name')";

        $db_connection->query($sql_data);

        $this->signInUser($user_name, $password);
        /*if($db_connection->query($sql_data) === true){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql_data. " . $db_connection->error;
        }*/
    }
}