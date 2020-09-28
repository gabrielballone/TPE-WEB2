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

    function showErrorRegister($message){
        $this->smarty->assign('messageError', $message);
        $this->smarty->display('templates/register.tpl');
    }

    function showManageUsers($users){
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/manage_users.tpl');
    }

    function confirmUserRemove($id, $name) {
        $this->smarty->assign('entityToRemove', "usuarios");
        $this->smarty->assign('name', $name);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/confirmation_remove.tpl');
    }
    
}
