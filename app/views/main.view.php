<?php
require_once 'libs/Smarty.class.php';

class MainView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    function showHome() {
        $this->smarty->display('templates/home.tpl');
    }

    function showRegister()
    {
        $this->smarty->display('templates/register.tpl');
    }

    function showLogin(){
        $this->smarty->display('templates/login.tpl');
    }

}