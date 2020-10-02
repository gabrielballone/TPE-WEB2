<?php
include_once 'app/views/main.view.php';

class MainController {

    private $view;

    function __construct() {       
        $this->view = new MainView();
    }

    /**
     * Imprime home
     */

    function showHome() {
       $this->view->showHome();
    }

    function showRegister(){
        $this->view->showRegister();
    }

    function showLogin(){
        
        $this->view->showLogin();
    }

}