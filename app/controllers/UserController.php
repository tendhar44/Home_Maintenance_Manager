<?php

/**
 * Name:
 * Date:
 */
class UserController extends Controller {
    public function index($userId = 0) {
        $this->view("list-user-page", ["uId" => $userId]);
    }

    public function add() {
        $this->notSignedIn();
        $this->view("add-user-page", []);
    }

    public function update($userId = 0) {
        $this->notSignedIn();
        $this->view("update-user-page", ["uId" => $userId]);
    }

    public function delete($userId = 0) {
        $this->view("delete-user-page", ["uId" => $userId]);
    }

    public function signIn() {
        $this->view("sign-in-page", []);

        if(isset($_POST['submit'])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if($this->model->getAccountManagement()->signInUser($username, $password)) {
                header('Location: /home_maintenance_manager/public/homecontroller/home');
            }else {
                echo '<span class="errorText">' . $_SESSION['signInError'] . "</span>";
            }
        }
    }

    public function signOut() {
        $this->notSignedIn();
        $this->model->getAccountManagement()->signOutUser();
        $this->view("sign-out-page", []);
        header("location: /home_maintenance_manager/public/homecontroller");
    }

    public function signUp() {
        $this->view("sign-up-page", []);        
        if(isset($_POST['submit'])) {
            echo "sumbitting a register";
            if($this->model->getAccountManagement()->signUpUser()) {
                header('Location: /home_maintenance_manager/public/homecontroller/home');
            }else {
                echo 'something went wrong';
                echo '<span class="errorText">' . $_SESSION['userNameError'] . "</span>";
                echo '<span class="errorText">' . $_SESSION['emailError'] . "</span>";
            }
        }
    }

}