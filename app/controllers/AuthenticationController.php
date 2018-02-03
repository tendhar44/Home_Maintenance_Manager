<?php

/**
 * Name:
 * Date:
 */
class AuthenticationController extends Controller {

    public function index (){
        $this->view("login-page", []);
    }

    public function logIn() {
        $this->view("login-page", []);
    }

    public function logOut() {

    }
}