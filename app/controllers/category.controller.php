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

    function showCategory($params) {
        if(isset($params[1])){
            $id = $params[1];
            $categories = $this->model->getAll();

            //filtra el array de categorias, lo convierte en un array de ids
            $arrayId = array_column($categories, 'id');

            //busca el id pasado en el array de ids y devuelve la posicion
            $category = $categories[array_search($id, $arrayId)];

            $courses = $this->modelCourse->getCoursesByCategory($id);
            $this->view->showCategory($categories,$courses, $category);
        }
       
    }

    
}