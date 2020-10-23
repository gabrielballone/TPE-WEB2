<?php
require_once 'libs/Router.php';
require_once 'app/api/api-course.controller.php';

// creo el router
$router = new Router();

// armo la tabla de ruteo
$router->addRoute('comentarios', 'GET', 'CommentController', 'getAll');
$router->addRoute('comentarios/:ID', 'GET', 'CommentController', 'get');
$router->addRoute('comentarios/:ID', 'DELETE', 'CommentController', 'delete');
$router->addRoute('comentarios', 'POST', 'CommentController', 'add');

// $router->addRoute('comentarios/:ID', 'PUT', 'CommentController', 'update');

// rutea
$router->route($_REQUEST['resource'],  $_SERVER['REQUEST_METHOD']);