<?php
include_once 'app/views/main.view.php';

class MainController
{

    private $view;
    /**
    * Se inicia la sesión y se crea objeto de vista asociada.
    */
    function __construct()
    {
        session_start();
        $this->view = new MainView();
    }

    /**
     * Manda a mostrar la pagina de inicio.
     */
    function showHome()
    {
        $this->view->showHome();
    }

    /**
     * Manda a mostrar error 404 si la URL llega inválida.
     */
    function showError404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->showError404();
    }
}
