<?php

class AuthHelper {
    public function __construct() {}

    public function login($user) {
        // INICIO LA SESSION Y LOGUEO AL USUARIO
        //session_start(); //ya iniciada en constructor
        $_SESSION['EMAIL'] = $user->email;
        $_SESSION['ID'] = $user->id;
        $_SESSION['ADMINISTRADOR'] = $user->administrador;
        header("Location: " . BASE_URL . "inicio");
        die();
    }

    public function logout() {
        //session_start(); //ya iniciada en constructor
        session_destroy();
    }

    public function checkLoggedIn() {
         //session_start(); //ya iniciada en constructor     
        return isset($_SESSION['ID']);
    }

    public function checkUserIsManager() {
        //session_start(); //iniciada en el constructor
        if(isset($_SESSION['ADMINISTRADOR']))
            return $_SESSION['ADMINISTRADOR'];
        else
            return false;
    }

    public function checkActualSessionId($id){
        if(isset($_SESSION['ID'])){
            return $_SESSION['ID'] == $id;
        }
        return false;
    }
}
