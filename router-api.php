<?php
require_once 'libs/Router.php';
require_once 'app/api/api-comment.controller.php';
// creo el router
$router = new Router();

// armo la tabla de ruteo
$router->addRoute('comentarios', 'GET', 'ApiCommentController', 'getAll');
$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentController', 'get');
$router->addRoute('comentarios', 'POST', 'ApiCommentController', 'add');
$router->addRoute('comentarios/:ID', 'DELETE', 'ApiCommentController', 'delete');
$router->addRoute('comentarios/:ID', 'PUT', 'ApiCommentController', 'update');

// rutea
$router->route($_REQUEST['resource'],  $_SERVER['REQUEST_METHOD']);