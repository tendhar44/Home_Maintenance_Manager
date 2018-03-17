<?php

/**
 * Name:
 * Date:
 */
class AccountManagement {
    private $conn;
    private $valid;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
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
        //attempt select query execution
        $sql_data = "SELECT userid, username, password, firstname, lastname, email FROM users WHERE username = '$username'";


        $userData = $this->conn->query($sql_data);
        //var_dump($userData['username']);

        return $userData->fetch_assoc();
    }

    public function updateUser($userid) {
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
        $sql_data = "UPDATE users SET firstname='$fn', lastname='$ln', email='$em', password='$pw' WHERE userid = '$userid'";

        if($this->conn->query($sql_data) === true) {
            echo "Successfully updated your profile!";
        } else {
            echo "We weren't able to update your profile. Please try again.";
        }
    }

    public function deleteUser($userid) {
        // attempt insert query execution
        $sql_data = "DELETE FROM users WHERE userid = '$userid'";

        if($this->conn->query($sql_data) === true) {
            echo "Successfully deleted your account!";
        } else {
            echo "We weren't able to delete your account. Please try again.";
        }

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

            // var_dump($row['username']);
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
        $username = (isset($_POST['userName'])) ? $_POST['userName'] : '';
        $firstname = (isset($_POST['firstName'])) ? $_POST['firstName'] : '';
        $lastname = (isset($_POST['lastName'])) ? $_POST['lastName'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';

        $username = mysqli_real_escape_string($db_connection, $username);
        $firstname = mysqli_real_escape_string($db_connection, $firstname);
        $lastname = mysqli_real_escape_string($db_connection, $lastname);
        $email = mysqli_real_escape_string($db_connection, $email);
        $password = mysqli_real_escape_string($db_connection, $password);

        // var_dump($username);
        // var_dump($firstname);
        // var_dump($lastname);
        // var_dump($email);
        // var_dump($password);

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

        
        
        // var_dump($authenticity);

        if($authenticity){
            // attempt insert query execution
            $sql_data = "INSERT INTO users (userTypeId, username, password, email, firstname, lastname) VALUES (1, '$username', '$password', '$email', '$firstname', '$lastname')";

            if($this->conn->query($sql_data)){                
                $this->signInUser($username, $password);
                return true;
            }
        }
        return false;
    }
}