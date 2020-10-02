<?php
// echo "entró al router principal"; 
// var_dump($_GET['action']);die();

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
session_start();

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'inicio':
        $controller = new MainController();
        $controller->showHome();
        break;
    default:
    header("HTTP/1.0 404 Not Found");
    echo ('404 Page not found');
    break;
}
    // case 'registro':
    //     $controller = new MainController();
    //     $controller->showRegister();
    //     break;
    // case 'ingreso':
    //     $controller = new MainController();
    //     $controller->showLogin();
    //     break;
    // case 'cursos': //cursos  cursos/:id
    //     echo "entro por router principal /cursos";
    //     // $routerCourses = $rout
    //     // $controller = new CourseController();
    //     // $controller->process($params);
    //     break;
    // case 'categorias': //categorias/:id
    //     $controller = new CategoryController();
    //     $controller->process($params);
    //     break;
    // case 'usuarios':
    //     $controller = new UserController();
    //     $controller->process($params);
    //     break;