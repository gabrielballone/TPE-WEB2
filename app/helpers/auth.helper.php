<?php

class AuthHelper
{
    public function __construct()
    {
        session_start();
    }

    public function checkLoggedIn()
    {    
        if (!isset($_SESSION['ID']) || !isset($_SESSION['EMAIL']) || !isset($_SESSION['ADMINISTRADOR'])) {
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
    }
}
