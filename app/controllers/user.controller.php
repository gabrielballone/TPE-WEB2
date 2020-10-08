<?php
include_once 'app/models/user.model.php';
include_once 'app/views/user.view.php';
include_once 'app/helpers/auth.helper.php';

class UserController
{

    private $model;
    private $view;
    private $authHelper;
    /**
    * Se inicia la sesión y se crean los objetos de modelos y vista asociados y helper de autenticación.
    */
    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    /**
     * Muesta el formulario de registro, si la sesion esta iniciada redirige a inicio
     */
    function showRegister()
    {
        if (isset($_SESSION['ID'])) {
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        $this->view->showRegister();
    }

    /**
     * Muesta el formulario de login, si la sesion esta iniciada redirige a inicio
     */
    function showLogin()
    {
        //si la sesion esta iniciada, redirigir a inicio
        if (isset($_SESSION['ID'])) {
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        $this->view->showLogin();
    }

    /**
     * Recibe formulario por POST y manda a crear usuario en la db
     * Si la sesion esta iniciada redirige a inicio
     */
    function createUser()
    {
        if (isset($_SESSION['ID'])) {
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            if (!$this->model->exist($_POST['email'])) {
                $this->model->insert($_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['nombre'], $_POST['telefono']);
                header("Location: " . BASE_URL . "usuarios/ingreso");
            } else {
                $this->view->showRegister("El email ya existe");
            }
        } else {
            $this->view->showRegister("Faltan datos, por favor completa todos los campos.");
        }
    }

    /**
     * Recibe formulario por POST, si el usuario es valido lo loguea
     * Si la sesion esta iniciada redirige a inicio
     */
    function login()
    {
        //si la sesion esta iniciada, redirigir a inicio
        if (isset($_SESSION['ID'])) {
            header("Location: " . BASE_URL . "inicio");
            die();
        }
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            $user = $this->model->getUserByEmail($_POST['email']);
            //comprobar si el usuario coincide con el password
            if ($user && password_verify($_POST['pass'], $user->password)) {
                //session_start(); //ya instanciada en constructor
                $_SESSION['EMAIL'] = $user->email;
                $_SESSION['ID'] = $user->id;
                $_SESSION['ADMINISTRADOR'] = $user->administrador;
                header("Location: " . BASE_URL . "inicio");
                die();
            } else {
                $this->view->showLogin("Email o Contraseña incorrectos");
            }
        } else {
            $this->view->showLogin("Faltan datos, por favor completa todos los campos.");
        }
    }

    /**
     * Manda a mostrar ABM(solo eliminar y editar administrador) de usuarios si el usuario es Administrador.
     */
    public function showManageUsers()
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $users = $this->model->getAll();
        $this->view->showManageUsers($users);
    }

    /**
     * Actualiza el perfil del usuario, parametros recibidos por POST.
     */
    function updateUser($id = null)
    {
        $this->authHelper->checkLoggedIn();
        if ($_SESSION['ID'] != $id) {
            header("Location: " . BASE_URL . "usuarios/modificar/" . $_SESSION['ID']);
            die();
        }

        if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            if($this->model->update($id, $_POST['email'], password_hash($_POST['pass'], PASSWORD_DEFAULT), $_POST['nombre'], $_POST['telefono']))
                $this->view->showEditUser(false, true);
            else
                $this->view->showEditUser(false, false);
        } else {
            $user = $this->model->getUser($id);
            //solucion para no pasar id por parametro
            //$user = $this->model->getUser($_SESSION['ID']);
            $this->view->showEditUser($user);
        }
    }

    /**
     * Modifica los permisos de administrar de un usuario, si el usuario que solicita
     *  el cambio es Administrador.
     */
    function setAdministrador($id, $administrador)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $this->model->setAdministrador($id, $administrador);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }

    /**
     * Manda a mostrar confirmacion para eliminar un usuario si el usuario es Administrador.
     */
    public function showConfirmation($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $user = $this->model->getUser($id);
        $email = $user->email;
        $this->view->confirmUserRemove($id, $email);
    }

    /**
     * Manda a eliminar un usuario a la db, si el usuario que solicita es Administrador.
     */
    function removeUser($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $this->model->remove($id);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }

    /**
     * Desloguea al usuario destruyendo la sesion actual
     */
    function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'inicio');
    }

    /**
     * Manda a mostrar error 404 si la URL llega inválida.
     */
    function showError404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->showError404();
    }
}
