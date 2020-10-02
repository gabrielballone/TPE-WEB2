<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/category.view.php';

class CategoryController
{

    private $model;
    private $modelCourse;
    private $view;

    function __construct()
    {
        $this->model = new CategoryModel();
        $this->modelCourse = new CourseModel();
        $this->view = new CategoryView();
    }

    

    public function showCategory($id)
    {
        $categories = $this->model->getAll();
        
        //filtra el array de categorias, lo convierte en un array de ids
        $arrayId = array_column($categories, 'id');
        
        //busca el id pasado en el array de ids y devuelve la posicion
        $category = $categories[array_search($id, $arrayId)];

        $courses = $this->modelCourse->getCoursesByCategory($id);
        $this->view->showCategory($categories, $courses, $category);
    }

    public function showManageCategories()
    { 
        $categories = $this->model->getAll();
        $this->view->showManageCategories($categories);
    }

    public function createCategory()
    {
        if(!empty($_POST['nombre']) && !empty($_POST['descripcion'])){
            $this->model->insert($_POST['nombre'], $_POST['descripcion']);
            header('Location: '. BASE_URL.'categorias/administrar');
        }
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
            $this->view->showError("No puedes eliminar la categoria, tiene cursos referenciados");
        }
    }
}
