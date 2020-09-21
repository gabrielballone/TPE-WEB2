<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/course.view.php';

class CourseController {

    private $model;
    private $modelCategory;
    private $view;

    function __construct() {
        $this->model = new CourseModel();
        $this->modelCategory = new CategoryModel();
        $this->view = new CourseView();
    }


    function show(){ 
        //parametros: cursos ,  , cursos/:id
        if(isset($params[1])){
            $this->showCourse($params[1]);
        }
        else{
            $this->showCourses();
        }
    }
 
    function showCourses() {
        // obtiene las tareas del modelo
        $courses = $this->model->getAll();
        $categories = $this->modelCategory->getAll();
        // actualizo la vista
        $this->view->showCourses($courses, $categories);
    }   

    function showCourse() {
        // obtiene las tareas del modelo
        $course = $this->model->getCourse();
        $categories = $this->modelCategory->getAll();

       // actualizo la vista
       $this->view->showCourse($course, $categories);
    }

    
}