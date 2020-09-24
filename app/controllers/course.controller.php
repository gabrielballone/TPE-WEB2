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

    public function process($params)
    {
        if (isset($params[1])) {
            switch ($params[1]) {
                case "administrar": //categorias
                    $this->showManageCourses();
                    break;
                case "nuevo": //categorias/nuevo
                    $this->createCourse();
                    break;
                case "modificar": //categorias/modificar/[id]
                    $this->updateCourse($params[2]);
                    break;
                case "eliminar": //categorias/eliminar/[id]
                    $this->removeCourse($params[2]);
                    break;
                default:
                    $this->showCourse($params[1]);
                    break;
            }
        } else {
            $this->showCourses();
        }
    }


    // function show($params){ 
    //     //parametros: cursos, cursos/:id
    //     if(isset($params[1])){
    //         $this->showCourse($params[1]);
    //     }
    //     else{
    //         $this->showCourses();
    //     }
    // }
 
    function showCourses() {
        // obtiene las tareas del modelo
        $courses = $this->model->getAll();
        $categories = $this->modelCategory->getAll();
        // actualizo la vista
        $this->view->showCourses($courses, $categories);
    }   

    function showCourse($id) {
        // obtiene las tareas del modelo
        $course = $this->model->getCourse($id);
        $categories = $this->modelCategory->getAll();

       // actualizo la vista
       $this->view->showCourse($course, $categories);
    }

    public function showManageCourses()
    {
        $courses = $this->model->getAll();
        $this->view->showManageCourses($categories);
    }

    public function createCourse()
    {
        if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['duracion'], $_POST['id_categoria'])) {
            $this->model->insert($_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['id_categoria']);
        }
    }

    public function updateCourse($id)
    {
        if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['duracion'], $_POST['id_categoria'])) {
            $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['duracion'], $_POST['id_categoria']);
        }
    }

    public function removeCourse($id)
    {
        $this->model->remove($id);
    }
    
}