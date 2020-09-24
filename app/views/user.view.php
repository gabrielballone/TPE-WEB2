<?php
require_once 'libs/Smarty.class.php';

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    function showError($message){
        $this->smarty->assign('messageError', $message);
        $this->smarty->display('templates/register.tpl');
    }

    
    
}
