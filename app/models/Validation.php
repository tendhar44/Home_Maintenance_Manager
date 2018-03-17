<?php

class Validation {
    private $db_connection;

    public function __construct($database_connection) {
        $this->db_connection = $database_connection;
    }

    public function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    public function checkSignUpUsername($username){
        if($this->checkInput($username) == '') return false;
        $query = sprintf("select username from users where username ='$username'");
        return $this->uniqueInput($query);
    }

    public function checkPassword($password){
        if($this->checkInput($password) == '') return false;
        $query = sprintf("select password from users where password ='$password'");
        return $this->uniqueInput($query);
    }

    public function checkEmail($email){
        if($this->checkInput($email) == '') return false;
        $query = sprintf("select email from users where email = '$email'");
        return $this->uniqueInput($query);
    }

    public function checkTaskName($taskName){
        if($this->checkInput($taskName) == '') return false;
        $query = sprintf("select taskname from tasks where taskname ='$taskName'");
        return $this->uniqueInput($query);
    }

    public function checkApplianceName($appID, $appName, $proID){
        if($this->checkInput($appName) == '') return false;
        $query = sprintf("
            SELECT a.appliancename FROM appliances a JOIN propertyappliancebridge pa ON a.applianceid = pa.applianceid WHERE pa.propertyid = '$proID' and a.applianceid = '$appID' and a.appliancename = '$appName'
            ");
        return $this->uniqueInput($query);
    }

    public function checkPropertyName($proName){
        if($this->checkInput($proName) == '') return false;
        $query = sprintf("select propertyname from properties where propertyname ='$proName'");
        return $this->uniqueInput($query);
    }

    public function uniqueInput($query){
        $result = $this->db_connection->query($query);

        if (!$result)
            echo "cannot connect to the database";
            return false;
        if (mysqli_num_rows($result)>0)
            return false;
        return true;
    }
}