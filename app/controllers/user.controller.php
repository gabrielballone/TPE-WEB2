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
                case "nuevo": //usuarios/nuevo
                    $this->createUser();
                break;
                case "modificar": //usuarios/modificar
                    $this->updateUser();
                break;
                case "eliminar": //usuarios/eliminar
                    $this->removeUser();
                break;
            }
        }
        else {
            header("Location: ".BASE_URL."inicio");
        }
    }
    
    
    
    function createUser()
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['telefono'])) {
            if(!$this->model->exist($_POST['email'])){
                $this->model->insert($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['telefono']);
                header("Location: ".BASE_URL."inicio");
            }
            else{
                $this->view->showError("El email ya existe");
            }  
        }
        else{
            header("Location: ".BASE_URL."inicio");
        } 
    }

    function updateUser(){

    }

    function removeUser(){
        
    }
    
}
