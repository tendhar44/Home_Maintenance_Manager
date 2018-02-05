<?php

/**
 * Name:
 * Date:
 */
class AccountController extends Controller {
    public function index(){
        $this->view("login-page", []);
    }

    public function create() {

    }

    public function signIn($user) {
        $this->view("login-page", []);
    }

    public function signUp(){

    }

    public function signOut($user) {

    }

    public function changePassword($user) {

    }

}