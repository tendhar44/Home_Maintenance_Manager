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
        $this->view("add-user-page", []);
    }

    public function update($userId = 0) {
        $this->view("update-user-page", ["uId" => $userId]);
    }

    public function delete($userId = 0) {
        $this->view("delete-user-page", ["uId" => $userId]);
    }

    public function signIn() {
        $this->view("sign-in-page", []);
    }

    public function signOut() {
        $this->view("sign-out-page", []);
    }

    public function signUp() {
        $this->view("sign-up-page", []);
    }

}