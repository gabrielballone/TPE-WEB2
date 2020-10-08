<?php
include_once 'app/controllers/user.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = $_GET['action'];
$params = explode('/', $action);
$controller = new UserController();

// determina que camino seguir según la acción
// var_dump($params);
if (isset($params[1])) {
    switch ($params[1]) {
        case "administrar":
            $controller->showManageUsers();
            break;
        case "registro":
            $controller->showRegister();
            break;
        case "verificarRegistro":
            $controller->createUser();
            break;
        case "ingreso":
            $controller->showLogin();
            break;
        case "verificarIngreso":
            $controller->login();
            break;
        case "modificar":
            if (isset($params[2])) {
                $controller->updateUser($params[2]);
            } else {
                $controller->updateUser();
            }
            break;
        case "set_administrador":
            if (isset($params[2]) && isset($params[3])) {
                $controller->setAdministrador($params[2], $params[3]);
            } else {
                $controller->showError404();
            }
            break;
        case "eliminar":
            if (isset($params[2])) {
                if ($params[2] == "confirmar") {
                    if (isset($params[3])) {
                        $controller->showConfirmation($params[3]);
                    } else {
                        $controller->showError404();
                    }
                } else {
                    $controller->removeUser($params[2]);
                }
            } else
                $controller->showError404();
            break;
        case "logout":
            $controller->logout();
            break;
        default:
            $controller->showError404();
            break;
    }
} else {
    $controller->showError404();
}
