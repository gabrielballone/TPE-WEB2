<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/category.view.php';

class CategoryController {

    private $model;
    private $modelCourse;
    private $view;

    function __construct() {
        $this->model = new CategoryModel();
        $this->modelCourse = new CourseModel();
        $this->view = new CourseView();
    }


    function show(){ 
        //parametros: cursos ,  , cursos/:id
        if(isset($params[1])){
            $this->showCategory($params[1]);
        }
        else{
            $this->showCategories();
        }
    }
 
    function showCategories() {
        // obtiene las tareas del modelo
        $categories = $this->model->getAll();
        // actualizo la vista
        $this->view->showCategory($categories);
    }   

    function showCategory() {
    /*
    ** PARA REVISAR. Debe recibir parametros. Uso de getAll
    */
        // obtiene las tareas del modelo
        $category = $this->modelCategory->getAll();

       // actualizo la vista
       $this->view->showCategory($category);
    }

    
}