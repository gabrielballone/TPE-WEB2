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

    function show()
    {
        if (isset($params[1])) {
            switch ($params[1]) {
                case "nuevo":
                    $this->createUser();
                break;
                case "modificar":
                    $this->updateUser();
                break;
                case "eliminar":
                    $this->removeUser();
                break;
            }
        }
        else {
            header("Location: inicio");
        }
    }
    
    
    
    function createUser()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nombre']) && isset($_POST['telefono'])) {
            $this->model->insert($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['telefono']);
            header("Location: inicio");
        } 
    }

    function updateUser(){

    }

    function removeUser(){
        
    }
    
}
