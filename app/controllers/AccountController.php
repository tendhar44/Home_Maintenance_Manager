<?php

/**
 * Name:
 * Date:
 */
class AccountController extends Controller {
    public function index(){
        $this->view("account-signin-page", []);
    }

    public function signIn($user) {
        $this->view("account-signin-page", []);
    }

    public function signUp(){
        $this->view("account-signup-page", []);
    }

    public function signOut($user) {
        $this->view("account-signout-page", []);
    }

    public function delete() {
        $this->view("account-delete-page", []);
    }

    public function update() {
        $this->view("account-update-page", []);
    }

}