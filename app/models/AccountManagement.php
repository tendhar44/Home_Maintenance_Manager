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

    
    private function alertMsg($msg){        
        echo '<script language="javascript">';
        echo 'alert("'. $msg .'")';
        echo '</script>';
    }

    public function isSignedIn() {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }
        if(isset($_SESSION['managerloggedin']) && $_SESSION['managerloggedin'] == true){
            return true;
        }
        if(isset($_SESSION['limitedloggedin']) && $_SESSION['limitedloggedin'] == true){
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
        $user_id = (isset($_POST['ownerid'])) ? $_POST['ownerid'] : '';
        $user_type = (isset($_POST['usertype'])) ? $_POST['usertype'] : '';
        $user_name = (isset($_POST['username'])) ? $_POST['username'] : '';
        $first_name = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';
        $last_name = (isset($_POST['lastname'])) ? $_POST['lastname'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $pass_word = (isset($_POST['password'])) ? $_POST['password'] : '';

        // attempt insert query execution
        $sql_data = "INSERT INTO users (usertypeid, username, firstname, lastname, email, password, logdelete) VALUES ('$user_type', '$user_name', '$first_name', '$last_name', '$email', '$pass_word', '0')";

        if($this->conn->query($sql_data) === true){
            echo "User added successfully.";
        } else{
            echo "ERROR: Could not add the user";
        }
    }

    public function getUser($username){
        //attempt select query execution
        $sql_data = "SELECT userid, usertypeid, username, password, firstname, lastname, email, logdelete FROM users WHERE username = '$username'";

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

        $fn = mysqli_real_escape_string($this->conn, $firstname);
        $ln = mysqli_real_escape_string($this->conn, $lastname);
        $em = mysqli_real_escape_string($this->conn, $email);
        $pw = mysqli_real_escape_string($this->conn, $password);

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
            $_SESSION['usertype'] = $row['usertypeid'];
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['userNameError'] = "";
            $this->setSignInUserType($row['usertypeid']);

            return true;
        }
        //}
        $_SESSION['signInError'] = 'Username or Password is incorrect';
        return false;
    }

    private function setSignInUserType($type){
        $_SESSION['owner'] = false;
        $_SESSION['manager'] = false;
        $_SESSION['limitedUser'] = false;
        if ($type == 1) {
            $_SESSION['owner'] = true;
            return;
        } else if ($type == 2){
            $_SESSION['manager'] = true;
        } else {
            $_SESSION['limitedUser'] = true;            
        }
        $this->setOwnerId();
    }

    private function setOwnerId(){  
        $userid = $_SESSION['userid'];  
        $stmt = "
        SELECT g.groupOwnerId 
        FROM groups g 
        INNER JOIN usergroupbridge ugb            
        WHERE ugb.userid = '$userid'
        LIMIT 1"; 
        
        $result = $this->conn->query($stmt);
        $row = mysql_fetch_row($result);
        $_SESSION['ownerid'] = $row['groupOwnerId'];


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

        $username = mysqli_real_escape_string($this->conn, $username);
        $firstname = mysqli_real_escape_string($this->conn, $firstname);
        $lastname = mysqli_real_escape_string($this->conn, $lastname);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

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
        }else{
            if(!$this->valid->checkEmail($email)){
                $_SESSION['emailError'] = 'Email address is taken';
                $authenticity = false;
            }
        }

        
        
        // var_dump($authenticity);

        if($authenticity){
            // attempt insert query execution
            $sql_data = "INSERT INTO users (userTypeId, username, password, email, firstname, lastname, logdelete) VALUES (1, '$username', '$password', '$email', '$firstname', '$lastname', '0')";

            if($this->conn->query($sql_data)){
                return true;
            }
        }
        return false;
    }
}