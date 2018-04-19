<?php

/**
 * Name:
 * Date:
 */
class UserController extends Controller {
    public function index($userId = 0) {
        $this->view("list-user-page", ["uId" => $userId]);
    }

    public function add($ownerId = 0) {
        $this->notSignedIn();
        $accManagement = $this->model->getAccountManagement();
        $this->view("add-user-page", ["useId" => $ownerId]);

        $groupManagement =  $this->model->getGroupManagement();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $accManagement->addUser();
            $groupManagement->addMember();
        }
    }

    public function update($userId = 0) {
        $this->notSignedIn();
        $accManagement = $this->model->getAccountManagement();
        $this->view("update-user-page", ["uId" => $userId]);

        // call update 
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_SESSION['userid'];
            $accManagement->updateUser($userID);
        }
    }

    public function delete($userId = 0) {
        $this->view("delete-user-page", ["uId" => $userId]);
    }

    public function signIn() {
        $this->view("sign-in-page", []);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if($this->model->getAccountManagement()->signInUser($username, $password)) {

                // $this->setGroupSession();

                if($_SESSION['owner'] == true){
                    header('Location: /home_maintenance_manager/public/homecontroller/home');
                }else if ($_SESSION['manager'] == true){
                    header('Location: /home_maintenance_manager/public/homecontroller/managerhome');
                }else {
                    header('Location: /home_maintenance_manager/public/homecontroller/limitedhome');
                }
            }
        }
    }

    public function signOut() {
        header("location: /home_maintenance_manager/public/homecontroller");
        $this->notSignedIn();
        $this->model->getAccountManagement()->signOutUser();
    }

    public function signUp() {
        $this->view("sign-up-page", []);        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            //echo "sumbitting a register";
            if(!$this->model->getAccountManagement()->signUpUser()) { 
                //echo 'something went wrong';
                echo '<span class="errorText">' . $_SESSION['userNameError'] . "</span>";
                echo '<span class="errorText">' . $_SESSION['emailError'] . "</span>";
            }
        }
    }



}
