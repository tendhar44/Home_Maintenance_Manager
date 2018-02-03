<?php
/**
 * Name:
 * Date:
 */

class HomeController extends Controller {

    //index(pram, pram2, ..) -- can have [2]pram, [3]pram2, ..
    public function index() {
        $user = $this->model("User");
        $user->name = "john doe";

        //view (view path, pram data or [] or empty)
        $this->view("home-page", ["name" => $user->name]);
    }

    public function test(){
        echo "testting";
    }
}