<?php

/**
 * Name:
 * Date:
 */
class Controller {
    public function model($model){
        require_once "../app/models/" . $model . ".php";

        //model that was passed in, now return as object
        return new $model();
    }

    public function view($view, $data = []) {
        require_once "../app/views/" . $view . ".php";
    }

}