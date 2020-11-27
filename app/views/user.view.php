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

    /**
     * Muestra formulario de registro, recibe parametro opcional mensaje de error.
     */
    function showRegister($message = "")
    {
        $this->smarty->assign('messageError', $message);
        $this->smarty->display('templates/register.tpl');
    }
  
    /**
     * Muestra formulario de login, recibe parametro opcional mensaje de error.
     */
    function showLogin($msg = "")
    {
        $this->smarty->assign('messageError', $msg);
        $this->smarty->display('templates/login.tpl');
    }
   
    /**
     * Muestra formulario para modificar perfil de usuario, 
     * recibe como parametro objeto usuario a modificar.
     */
    function showManageUsers($users)
    {
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/manage_users.tpl');
    }

    /**
     * Muestra mensaje de confirmacion para eliminar un usuario,
     * recibe por parametro id y email del usuario a eliminar 
     */
    function confirmUserRemove($id, $email, $equalUser = false)
    {
        $this->smarty->assign('entityToRemove', "usuarios");
        $this->smarty->assign('name', $email);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('equalUser', $equalUser);
        $this->smarty->display('templates/confirmation_remove.tpl');
    }

     /**
     * Muestra formulario para editar perfil de usuario, recibe como parametro
     * un objeto usuario y como parametro opcional la consulta sql como un boolean 
     */
    function showEditUser($user, $success = false)
    {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('success', $success);
        $this->smarty->display('templates/edit_user.tpl');
    }

    /**
     * Muestra mensaje de error 404.
     */
    function showError404()
    {
        $this->smarty->display('templates/error404.tpl');
    }
}
