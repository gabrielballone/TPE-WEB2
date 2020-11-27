<?php

class AuthHelper
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Si el usuario no esta logueado redirigue al login y corta la ejecucion.
     */
    public function checkLoggedIn()
    {
        if (!isset($_SESSION['ID']) || !isset($_SESSION['EMAIL']) || !isset($_SESSION['ADMINISTRADOR'])) {
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
    }

    /**
     * Comprueba si el usuario logueado es administrador, si no lo es muestrar error 404 
     * y corta ejecucion. Recibe como parametro la vista que contiene el tpl de error
     */
    public function checkUserIsManager($view)
    {
        $this->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $view->showError404();
            die();
        }
    }

    /**
     * Comprueba si la session esta iniciada, en caso de que lo este redirige al inicio y corta la ejecucion.
     */
    public function checkSessionIsStarted()
    {
        if (isset($_SESSION['ID'])) {
            header("Location: " . BASE_URL . "inicio");
            die();
        }
    }

    /**
     * Inicia la session y redirige al inicio.
     */
    public function startSession($user)
    {
        $_SESSION['EMAIL'] = $user->email;
        $_SESSION['ID'] = $user->id;
        $_SESSION['ADMINISTRADOR'] = $user->administrador;
        header("Location: " . BASE_URL . "inicio");
        die();
    }

    /**
     * Devuelve el id del usuario de la session actual.
     */
    public function getId()
    {
        return $_SESSION['ID'];
    }

     /**
     * Desloguea al usuario destruyendo la sesion actual
     */
    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'inicio');
    }
}
