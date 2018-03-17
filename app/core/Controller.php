<?php

/**
 * Name:
 * Date:
 */
class Controller {
	
	protected $model;

    public function __construct() {
    	$this->model = new Model;
    }

    protected function view($view, $data = []) {

        require_once('../app/config/config.php');
        require_once "../app/views/" . $view . ".php";
    }

    protected function notSignedIn(){
        require_once('../app/config/config.php');
        if (!$this->model->getAccountManagement()->isSignedIn()) {
            header('Location: ' . BASE_LINK);
            exit();
        }
    }

}