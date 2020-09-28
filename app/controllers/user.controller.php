<?php
include_once 'app/models/user.model.php';
include_once 'app/views/user.view.php';

class UserController
{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    function process($params)
    {
        if (isset($params[1])) {
            switch ($params[1]) {
                case "administrar":
                    $this->showManageUsers();
                    break;
                case "nuevo":
                    $this->createUser();
                    break;
                case "modificar":
                    if (isset($params[2])) {
                        $this->updateUser($params[2]);
                    } else {
                        header("Location: " . BASE_URL . "usuarios/administrar");
                    }
                    break;
                case "set_administrador":
                    if (isset($params[2]) && isset($params[3])) {
                        $this->setAdministrador($params[2], $params[3]);
                    } else {
                        header("Location: " . BASE_URL . "usuarios/administrar");
                    }
                    break;
                case "eliminar":
                    if (isset($params[2]) && $params[2] == "confirmar") {
                        if (isset($params[3])) {
                            $this->showConfirmation($params[3]);
                        } else {
                            header("Location: " . BASE_URL . "usuarios/administrar");
                        }
                    } else {
                        $this->removeUser($params[2]);
                    }
                    break;
                default:
                    header("Location: " . BASE_URL . "usuarios/administrar");
                    break;
            }
        } else {
            header("Location: " . BASE_URL . "inicio");
        }
    }

    public function showManageUsers()
    {
        $users = $this->model->getAll();
        $this->view->showManageUsers($users);
    }

    function createUser()
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            if (!$this->model->exist($_POST['email'])) {
                $this->model->insert($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['telefono']);
                header("Location: " . BASE_URL . "inicio");
            } else {
                $this->view->showErrorRegister("El email ya existe");
            }
        } else {
            header("Location: " . BASE_URL . "inicio");
        }
    }

    function updateUser($id)
    {
        if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            $this->model->update($id, $_POST['email'], $_POST['pass'], $_POST['nombre'], $_POST['telefono']);
            $this->view->showEditUser();
        } 
        else{
            $user = $this->model->getUser($id);
            $this->view->showEditUser($user);
        }
        
    }

    function setAdministrador($id, $administrador)
    {
        $this->model->setAdministrador($id, $administrador);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }

    public function showConfirmation($id)
    {
        $user = $this->model->getUser($id);
        $email = $user->email;
        $this->view->confirmUserRemove($id, $email);
    }

    function removeUser($id)
    {
        $this->model->remove($id);
        header('Location: ' . BASE_URL . 'usuarios/administrar');
    }
}
