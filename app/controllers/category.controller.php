<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/category.view.php';
include_once 'app/helpers/auth.helper.php';


class CategoryController
{

    private $model;
    private $modelCourse;
    private $view;
    private $authHelper;

    function __construct()
    {
        session_start();
        $this->model = new CategoryModel();
        $this->modelCourse = new CourseModel();
        $this->view = new CategoryView();
        $this->authHelper = new AuthHelper();
    }

    public function showCategory($id)
    {
        $category = $this->model->getCategory($id);
        if(!empty($category)){
            $categories = $this->model->getAll();
            $courses = $this->modelCourse->getCoursesByCategory($id);
            $this->view->showCategory($categories, $courses, $category);
        }
        else{
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
        }
    }

    public function showManageCategories()
    { 
        if (!$this->authHelper->checkUserIsManager()){
            header("Location: " . BASE_URL . "usuarios/ingreso");
            die();
        }
        $categories = $this->model->getAll();
        $this->view->showManageCategories($categories);
    }

    public function createCategory()
    {
        if(!empty($_POST['nombre']) && !empty($_POST['descripcion'])){
            //comprobar errores SQL
            $this->model->insert($_POST['nombre'], $_POST['descripcion']);
        }
        header('Location: '. BASE_URL.'categorias/administrar');

    
    }

    public function updateCategory($id)
    {
        if(!empty($_POST['nombre']) && !empty($_POST['descripcion'])){
            $this->model->update($id, $_POST['nombre'], $_POST['descripcion']);
            header('Location: '. BASE_URL.'categorias/administrar');
        }
        else{
            $categories = $this->model->getAll();
            $category = $this->model->getCategory($id);
            $this->view->showManageCategories($categories, $category);
        }
    }

    public function showConfirmation($id)
    {
        $category = $this->model->getCategory($id);
        $name = $category->nombre;
        $this->view->confirmCategoryRemove($id, $name);
    }

    public function removeCategory($id)
    {
        if(!count($this->modelCourse->getCoursesByCategory($id))){
            $this->model->remove($id);
            header('Location: '. BASE_URL.'categorias/administrar');
        }
        else{
            $this->view->showError("La categoria tiene cursos asignados, no se puede eliminar.");
        }
    }
}
