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
        $this->view = new CategoryView();
    }


    // function show(){ 
    //     //parametros: categorias, categorias/:id
    //     if(isset($params[1])){
    //         $this->showCategory($params[1]);
    //     }
    //     else{
    //         $this->showCategories();
    //     }
    // }
 
    // function showCategories() {
    //     $categories = $this->model->getAll();
    //     $this->view->showCategories($categories);
    // }   

    function showCategory($id) {
        $category = $this->model->getCategory($id);
        // $courses = $this->modelCourse->getAll();
        $courses = $this->modelCourse->getCoursesByCategory($id);

       $this->view->showCategory($category,$courses);
    }

    
}