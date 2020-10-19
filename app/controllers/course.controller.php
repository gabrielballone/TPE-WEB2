<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/course.view.php';
include_once 'app/helpers/auth.helper.php';

class CourseController
{
    private $model;
    private $modelCategory;
    private $view;
    private $authHelper;
    /**
    * Se inicia la sesión y se crean los objetos de modelos y vistas asociados.
    */
    function __construct()
    {
        $this->model = new CourseModel();
        $this->modelCategory = new CategoryModel();
        $this->view = new CourseView();
        $this->authHelper = new AuthHelper();
    }
     /**
     * Obtiene todos los cursos con el nombre de categoría relacionado y manda a mostrar.
     */
    function showCourses()
    {
        $courses = $this->model->getAllInnerCategoryName();
        $categories = $this->modelCategory->getAll();
        $this->view->showCourses($courses, $categories);
    }
     /**
     * Obtiene un curso por ID con el nombre de categoría relacionado y manda a mostrar.
     * Si no existe el ID muestrar error 404.
     */
    function showCourse($id)
    {
        $course = $this->model->getCourseInnerCategoryName($id);
        if (!empty($course)) {
            $categories = $this->modelCategory->getAll();
            $this->view->showCourse($course, $categories);
        } else {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
        }
    }
    /**
     * Manda a mostrar ABM de cursos si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function showManageCourses()
    {
        if (!$this->authHelper->userIsManager()) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $courses = $this->model->getAllInnerCategoryName();
        $categories = $this->modelCategory->getAll();
        $this->view->showManageCourses($courses, $categories);
    }
    /**
     * Manda a crear curso con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function createCourse()
    {
        if (!$this->authHelper->userIsManager()) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        if (!empty($_POST['nombre']) &&  !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['duracion']) && !empty($_POST['categoria'])) {
            if ($this->model->insert($_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria']))
                header('Location: ' . BASE_URL . 'cursos/administrar');
            else
                $this->view->showError("Ya existe una curso con ese nombre!");
        }
    }
    /**
     * Manda a actualizar curso con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function updateCourse($id)
    {
        if (!$this->authHelper->userIsManager()) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['duracion']) && !empty($_POST['precio']) && !empty($_POST['categoria'])) {
            if ($this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria']))
                header('Location: ' . BASE_URL . 'cursos/administrar');
            else
                $this->view->showError("Ya existe una curso con ese nombre!");
        } else {
            $courses = $this->model->getAllInnerCategoryName();
            $categories = $this->modelCategory->getAll();
            $couse = $this->model->getCourse($id);
            $this->view->showManageCourses($courses, $categories, $couse);
        }
    }
    /**
     * Manda a eliminar curso con datos del fomulario de ABM si el usuario es Administradors.
     * Si no es administrador muestrar error 404.
     */
    public function removeCourse($id)
    {
        if (!$this->authHelper->userIsManager()) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $this->model->remove($id);
        header('Location: ' . BASE_URL . 'cursos/administrar');
    }
    /**
     * Manda a mostrar confirmación para eliminar curso si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function showConfirmation($id)
    {
        if (!$this->authHelper->userIsManager()) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $course = $this->model->getCourse($id);
        $name = $course->nombre;
        $this->view->confirmCourseRemove($id, $name);
    }
    /**
     * Manda a mostrar error 404 si la URL llega inválida.
     */
    function showError404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->showError404();
    }
}
