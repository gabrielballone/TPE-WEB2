<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/course.view.php';
include_once 'app/helpers/auth.helper.php';

class CourseController {

    private $model;
    private $modelCategory;
    private $view;
    private $authHelper;

    function __construct() {
        session_start();
        $this->model = new CourseModel();
        $this->modelCategory = new CategoryModel();
        $this->view = new CourseView();
        $this->authHelper = new AuthHelper();
    }
 
    function showCourses() {
        $courses = $this->model->getAll();
        $categories = $this->modelCategory->getAll();
        $this->view->showCourses($courses, $categories);
    }   

    function showCourse($id)
    {
        $course = $this->model->getCourse($id);
        if(!empty($course)){
            $categories = $this->modelCategory->getAll();
            $this->view->showCourse($course, $categories);
        }
        else{
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
        }
    }

    public function showManageCourses()
    {
        if (!$this->authHelper->checkUserIsManager()){
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
        $courses = $this->model->getAllInnerCategoyName();
        $categories = $this->modelCategory->getAll();
        $this->view->showManageCourses($courses, $categories);
    }

    public function showConfirmation($id)
    {
        $course = $this->model->getCourse($id);
        $name = $course->nombre;
        $this->view->confirmCourseRemove($id, $name);
    }

    public function createCourse()
    {
        if (!empty($_POST['nombre']) &&  !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['duracion']) && !empty($_POST['categoria'])) {
            $this->model->insert($_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria']);
            header('Location: '. BASE_URL.'cursos/administrar');
        }
    }

    public function updateCourse($id)
    {
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['duracion']) && !empty($_POST['categoria'])) {
            $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['duracion'], $_POST['categoria']);
            header('Location: '. BASE_URL.'cursos/administrar');
        }
        else{
            $courses = $this->model->getAllInnerCategoyName();
            $categories = $this->modelCategory->getAll();
            $couse = $this->model->getCourse($id);
            $this->view->showManageCourses($courses, $categories, $couse);
        }
    }

    public function removeCourse($id)
    {
        $this->model->remove($id);
        header('Location: '. BASE_URL.'cursos/administrar');
    }
    
}