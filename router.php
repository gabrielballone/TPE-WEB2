<?php
include_once 'app/controllers/main.controller.php';
include_once 'app/controllers/course.controller.php';
include_once 'app/controllers/category.controller.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'inicio'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'inicio':
        $controller = new MainController();
        $controller->showHome();
        break;
    case 'cursos': //cursos  cursos/:id
        $controller = new CourseController();
        //$controller->showCourses($params);
        $controller->show($params);
        break;
    case 'categorias':
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo('404 Page not found');
        break;
}
