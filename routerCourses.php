<?php
include_once 'app/controllers/course.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = $_GET['action'];
$params = explode('/', $action);
$controller = new CourseController();
session_start();

// determina que camino seguir según la acción
if (isset($params[1])) {
    switch ($params[1]) {
        case "administrar": 
            $controller->showManageCourses();
            break;
        case "nuevo": 
            $controller->createCourse();
            break;
        case "modificar":  
            if(isset($params[2]))
                $controller->updateCourse($params[2]);
            else
                header("Location: " . BASE_URL . "cursos/administrar");
            break;
        case "eliminar": 
            if(isset($params[2])){
                if($params[2] == "confirmar"){
                    if(isset($params[3]))
                        $controller->showConfirmation($params[3]);
                    else
                        header("Location: " . BASE_URL . "cursos/administrar");   
                }
                else
                    $controller->removeCourse($params[2]);
            }
            else
                header("Location: " . BASE_URL . "cursos/administrar");
            break;
        default:
            $controller->showCourse($params[1]);
            break;
    }
} else {
    $controller->showCourses();
}
