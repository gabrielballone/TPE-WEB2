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
                case "administrar": 
                    $this->showManageCourses();
                    break;
                case "nuevo": 
                    $this->createCourse();
                    break;
                case "modificar": //categorias/modificar/[id]
                    if(isset($params[2])){ 
                        $this->updateCourse($params[2]);
                    }
                    else{
                        header("Location: " . BASE_URL . "cursos/administrar");
                    }
                    break;
                case "eliminar": 
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
 
    function showCourses() {
        $courses = $this->model->getAll();
        $categories = $this->modelCategory->getAll();
        $this->view->showCourses($courses, $categories);
    }   

    function showCourse($id) {
        $course = $this->model->getCourse($id);
        $categories = $this->modelCategory->getAll();
        $this->view->showCourse($course, $categories);
    }

    public function showManageCourses()
    {
        $courses = $this->model->getAll();
        $categories = $this->modelCategory->getAll();
        $this->view->showManageCourses($courses, $categories);
    }

    public function createCourse()
    {
        if (!empty($_POST['nombre']) &&  !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['duracion']) && !empty($_POST['selectCategoria'])) {
            $this->model->insert($_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['id_categoria']);
        }
    }

    public function updateCourse($id)
    {
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['duracion']) && !empty($_POST['selectCategoria'])) {
            $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['duracion'], $_POST['selectCategoria']);
            header('Location: '. BASE_URL.'cursos/administrar');
        }
        else{
            $courses = $this->model->getAll();
            $categories = $this->modelCategory->getAll();
            $couse = $this->model->getCourse($id);
            $this->view->showManageCourses($courses, $categories, $couse);
        }
    }

    public function removeCourse($id)
    {
        $this->model->remove($id);
    }
    
}