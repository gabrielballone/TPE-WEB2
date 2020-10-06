<?php
include_once 'app/views/main.view.php';

class MainController {

    private $view;

    function __construct() {       
        $this->view = new MainView();
    }

    function showHome() {
       $this->view->showHome();
    }

}