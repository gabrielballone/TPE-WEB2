<?php
require_once 'libs/Smarty.class.php';

class MainView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    /**
     * Muestra la pagina de inicio.
     */
    function showHome()
    {
        $this->smarty->display('templates/home.tpl');
    }

    /**
     * Muestra mensaje de error 404.
     */
    function showError404()
    {
        $this->smarty->display('templates/error404.tpl');
    }
}
