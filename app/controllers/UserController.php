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

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $accManagement->addUser();
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

    }

    public function signOut() {
        $this->notSignedIn();
        $this->model->getAccountManagement()->signOutUser();
        header("location: /home_maintenance_manager/public/homecontroller");
    }

    public function signUp() {
        $this->view("sign-up-page", []);        
        if(isset($_POST['submit'])) {
            //echo "sumbitting a register";
            if($this->model->getAccountManagement()->signUpUser()) {
                $this->view("sign-in-page");
            }else {
                //echo 'something went wrong';
                echo '<span class="errorText">' . $_SESSION['userNameError'] . "</span>";
                echo '<span class="errorText">' . $_SESSION['emailError'] . "</span>";
            }
        }
    }

}