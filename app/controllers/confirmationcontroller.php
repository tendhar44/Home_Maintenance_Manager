<?php

class ConfirmationController extends Controller{
    public function index() {
        $this->view("confirmation-page", []);
    }

    public function thankYou() {
        $this->view("confirmation-thankyou-page", []);
    }

    public function confirmationSignUp() {
        $this->view("confirmation-signup-page", []);
    }

}
