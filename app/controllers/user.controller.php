<?php
include_once 'app/models/user.model.php';
include_once 'app/views/user.view.php';
include_once 'app/helpers/auth.helper.php';

class UserController
{

    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        session_start();
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    function showRegister()
    {
         //si la sesion esta iniciada, redirigir a inicio
         if ($this->authHelper->checkLoggedIn()){
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        $this->view->showRegister();
    }

    function showLogin()
    {
         //si la sesion esta iniciada, redirigir a inicio
         if ($this->authHelper->checkLoggedIn()){
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        $this->view->showLogin();
    }

    function createUser()
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            if (!$this->model->exist($_POST['email'])) {
                $this->model->insert($_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['nombre'], $_POST['telefono']);
                header("Location: " . BASE_URL . "usuarios/ingreso");
            } else {
                $this->view->showErrorRegister("El email ya existe");
            }
        } else {
            $this->view->showErrorRegister("Faltan datos, por favor completa todos los campos.");
        }
    }

    function login()
    {
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            $user = $this->model->getUserByEmail($_POST['email']);
            //comprobar si el usuario coincide con el password
            if ($user != null && password_verify($_POST['pass'], $user->password)) {                
                //session_start(); //ya instanciada en constructor
                $_SESSION['EMAIL'] = $user->email;
                $_SESSION['ID'] = $user->id;
                $_SESSION['ADMINISTRADOR'] = $user->administrador;
                header("Location: " . BASE_URL . "inicio");
                die();
            } 
            else {
                $this->view->showErrorLogin("Email o Contraseña incorrectos");
            }
        } 
        else {
            $this->view->showErrorLogin("Faltan datos, por favor completa todos los campos.");
        }
    }

    public function showManageUsers()
    {
        if (!$this->authHelper->checkUserIsManager()){
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
        $users = $this->model->getAll();
        $this->view->showManageUsers($users);
    }

    function updateUser($id=null) //usuarios/modificar/:id
    {
        if (!$this->authHelper->checkActualSessionId($id)){
            if($this->authHelper->checkLoggedIn()){
                header("Location: " . BASE_URL . "usuarios/modificar/".$_SESSION['ID']);
                die();
            }
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
       
        if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            $this->model->update($id, $_POST['email'], password_hash($_POST['pass'], PASSWORD_DEFAULT), $_POST['nombre'], $_POST['telefono']);
            $this->view->showEditUser();
        } else {
            $user = $this->model->getUser($id);
            $this->view->showEditUser($user);
        }
    }

    function setAdministrador($id, $administrador)
    {
        if (!$this->authHelper->checkUserIsManager()){
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
        $this->model->setAdministrador($id, $administrador);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }

    public function showConfirmation($id)
    {
        if (!$this->authHelper->checkUserIsManager()){
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
        $user = $this->model->getUser($id);
        $email = $user->email;
        $this->view->confirmUserRemove($id, $email);
    }

    function removeUser($id)
    {
        $this->model->remove($id);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }

    function logout()
    {
        // session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'inicio');
    }
}
