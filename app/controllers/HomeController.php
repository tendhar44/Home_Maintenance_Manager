<?php
/**
 * Name:
 * Date:
 */

class HomeController extends Controller {

    //index(pram, pram2, ..) -- can have [2]pram, [3]pram2, ..
    public function index() {
        $this->view("home-page", []);
    }

    public function home(){
        $this->view("home-page-loggedin", []);
    }
}