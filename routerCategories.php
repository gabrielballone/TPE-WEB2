<?php
include_once 'app/controllers/category.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = $_GET['action'];
$params = explode('/', $action);
$controller = new CategoryController();

// determina que camino seguir según la acción
if (isset($params[1])) {
    switch ($params[1]) {
        case "administrar":
            $controller->showManageCategories();
            break;
        case "nuevo": //categorias/nuevo
            $controller->createCategory();
            break;
        case "modificar": //categorias/modificar/[id]
            if (isset($params[2]))
                $controller->updateCategory($params[2]);
            else
                $controller->showError404();
            break;
        case "eliminar": //categorias/eliminar/[id]  categorias/eliminar/confirmar/[id]
            if (isset($params[2])) {
                if ($params[2] == "confirmar") {
                    if (isset($params[3]))
                        $controller->showConfirmation($params[3]);
                    else
                        $controller->showError404();
                } else
                    $controller->removeCategory($params[2]);
            } else
                $controller->showError404();
            break;
        default:
            $controller->showCategory($params[1]);
            break;
    }
} else {
    $controller->showError404();
}
