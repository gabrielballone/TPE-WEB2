<?php
include_once 'app/controllers/main.controller.php';

// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'inicio'; // acción por defecto si no envían
}

$params = explode('/', $action);
$controller = new MainController();

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'inicio':
        $controller->showHome();
        break;
    default:
        $controller->showError404();
        break;
}
