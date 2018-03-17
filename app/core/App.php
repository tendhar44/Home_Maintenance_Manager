<?php
/**
 * Name:
 * Date:
 */

class App {

    protected $controller = "homecontroller";
    protected $method = "index";
    protected $params = [];
    protected $model;

    /**
     * App constructor.
     * [0] controller
     * [1] function
     * [2] parameter
     * [3] parameter
     */
    public function __construct() {
       $url = $this->parseUrl();

       require_once "../app/core/Model.php";
       $this->model = new Model();

       //if file exist in controllers
       if(file_exists("../app/controllers/" . $url[0] . ".php")) {
           $this->controller = $url[0];
           unset($url[0]);
       }

       //if file don't exist, use default $controller = 'home'
       require_once "../app/controllers/" . $this->controller . ".php";

       $this->controller = new $this->controller;

       if(isset($url[1])){
           if(method_exists($this->controller, $url[1])) {
               $this->method = $url[1];
               unset($url[1]);
           }
       }

       //catch empty param array
       $this->params = $url ? array_values($url) : [];

       call_user_func_array([$this->controller, $this->method], $this->params);
    }

    //checks the '/' in the link
    public function parseUrl() {
        if(isset($_GET["url"])) {
            return $url = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
    }
}
