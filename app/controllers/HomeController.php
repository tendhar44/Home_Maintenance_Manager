<?php
/**
 * Name:
 * Date:
 */

class HomeController extends Controller {

    //index(pram, pram2, ..) -- can have [2]pram, [3]pram2, ..
    public function index() {
        //view (view path, pram data or [] or empty)
        $this->view("home-page", []);
    }
}