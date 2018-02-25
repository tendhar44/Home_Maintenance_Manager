<?php

/**
 * Name:
 * Date:
 */

class User {
    private $database;
    private $valid;

    protected $userid;
    protected $userName;
    protected $passWord;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $type;



    public function __construct($database, $validation) {
        $this->database = $database;
        $this->valid = $validation;
    }

    public function isSignedIn() {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }
    }

    public function getUserProperty(){
        $useridarray = array();

        for($i = 0; $i < sizeof($useridarray); $i++) {
            $_SESSION['userid' . $i] = $useridarray[$i];
            return $useridarray[$i];
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
        //require_once("../app/DatabaseConnection.php");

        //$db_con = new DatabaseConnection();
        //$db_connection = $db_con->db_connect();
        $db_connection = $this->database;

        //attempt select query execution
        $sql_data = "SELECT * FROM user WHERE username = '$username'";

        $userData = $db_connection->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateUser($userid) {
        $db_con = new DatabaseConnection();
        $db_connection = $db_con->db_connect();
        //$db_connection = $this->database;

        $firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';
        $lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        $fn = mysqli_real_escape_string($db_connection, $firstname);
        $ln = mysqli_real_escape_string($db_connection, $lastname);
        $em = mysqli_real_escape_string($db_connection, $email);
        $pw = mysqli_real_escape_string($db_connection, $password);

        // attempt insert query execution
        $sql_data = "UPDATE user SET firstname='$fn', lastname='$ln', email='$em', password='$pw' WHERE userid = '$userid'";

        if($db_connection->query($sql_data) === true) {
            echo "Successfully updated your profile!";
        } else {
            echo "We weren't able to update your profile. Please try again.";
        }
    }

    public function deleteUser() {

    }

    /**
     * This method returns true if username is more than 3 and less than 17.
     * @param $username
     * @return bool
     */
    public function isValidUsername($username){
        $userName = $this->valid->checkInput($username);
        if (strlen($userName) < 3) return false;
        if (strlen($userName) > 17) return false;
        if (!ctype_alnum($userName)) return false;
        return true;
    }

    //turn the password into hash code
    public function passwordHash($password, $hashCode) {

    }

    /**
     * This method checks and validates the username and password to let user sign in.
     * @param $username
     * @param $password
     * @return bool
     */
    public function signInUser($username,$password) {
        //checks the username for extra space, backslash and gets rid of it
        $username = $this->valid->checkInput($username);

        //if($this->valid->checkUsername($username)){
            $password = $this->valid->checkInput($password);

            $row = $this->getUser($username);

            //if username and password matches then let user log in
            if($username == $row['username'] && $password == $row['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['password'] = $row['password'];
                return true;
            }
        //}
        $_SESSION['signInError'] = 'Username or Password is incorrect';
        return false;
    }

    /**
     * This method signs user out by destroying the session.
     */
    public function signOutUser() {
        session_destroy();
    }

    /**
     * This method checks and validates the username and email to make sure it does not exist in the database.
     * Then it signs user up for an account.
     * @return bool
     */
    public function signUpUser() {
        $authenticity = true;
        $db_connection = $this->database;

        $username = (isset($_POST['userName'])) ? $_POST['userName'] : '';
        $firstname = (isset($_POST['firstName'])) ? $_POST['firstName'] : '';
        $lastname = (isset($_POST['lastName'])) ? $_POST['lastName'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';

        if(!$this->isValidUsername($username)){
            $authenticity = false;
            $_SESSION['userNameError'] = 'Username should be 3-17 characters long.';
        }else{
            if(!$this->valid->checkSignUpUsername($username)){
                $authenticity = false;
                $_SESSION['userNameError'] = 'Username is taken';
            }
        }

        if($email == ''){
            $_SESSION['emailError'] = 'Please enter an Email address';
            $authenticity = false;
        }else if(!$this->valid->checkEmail($email)){
            $_SESSION['emailError'] = 'Email address is taken';
            $authenticity = false;
        }

        if($authenticity){
            // attempt insert query execution
            $sql_data = "INSERT INTO user (username, password, email, firstname, lastname) VALUES ('$username', '$password', '$email', '$firstname', '$lastname')";

            $db_connection->query($sql_data);

            $this->signInUser($username, $password);

            return true;
        }
        return false;
    }
}