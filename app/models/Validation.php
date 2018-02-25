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

    public function checkUsername($username){
        if($this->checkInput($username) == '') return false;
        $query = sprintf("select * from user where username ='$username'");
        return $this->uniqueInput($query);
    }

    public function checkSignUpUsername($username){
        if($this->checkInput($username) == '') return false;
        $query = sprintf("select * from user where username ='$username'");
        return $this->uniqueInput($query);
    }

    public function checkPassword($password){
        if($this->checkInput($password) == '') return false;
        $query = sprintf("select * from user where password ='$password'");
        return $this->uniqueInput($query);
    }

    public function checkEmail($email){
        if($this->checkInput($email) == '') return false;
        $query = sprintf("select * from user where email = '$email'");
        return $this->uniqueInput($query);
    }

    public function uniqueInput($query){
        $result = $this->db_connection->query($query);
        if (!$result)
            return false;
        if (mysqli_num_rows($result)>0)
            return false;
        return true;
    }
}