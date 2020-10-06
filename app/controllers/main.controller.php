<?php
include_once 'app/views/main.view.php';

class MainController {

    private $view;

    function __construct() {       
        session_start();
        $this->view = new MainView();
    }

    function showHome() {
       $this->view->showHome();
    }
    
    function showError404() {
       header("HTTP/1.0 404 Not Found");
       $this->view->showError404();
    }

}