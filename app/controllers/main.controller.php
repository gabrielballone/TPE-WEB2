<?php
include_once 'app/views/main.view.php';

class MainController {

    private $model;
    private $view;

    function __construct() {       
        $this->view = new MainView();
    }

    /**
     * Imprime home
     */
    function showHome() {
        // muestra Home
       // actualizo la vista
       $this->view->showHome();
    }
}