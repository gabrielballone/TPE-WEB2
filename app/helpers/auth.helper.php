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
     * Devuelve true si el usuario esta logueado y es administrador, caso contrario false.
     */
    public function userIsManager()
    {
        $this->checkLoggedIn();
        return $_SESSION['ADMINISTRADOR'];
    }
}
