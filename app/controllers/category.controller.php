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

    public function process($params)
    {
        if (isset($params[1])) {
            switch ($params[1]) {
                case "administrar": //categorias
                    $this->showManageCategories();
                    break;
                case "nuevo": //categorias/nuevo
                    $this->createCategory();
                    break;
                case "modificar": //categorias/modificar/[id]
                    if(isset($params[2])){ 
                        $this->updateCategory($params[2]);
                    }
                    else{
                        header("Location: " . BASE_URL . "categorias/administrar");
                    }
                    break;
                case "eliminar": //categorias/eliminar/[id]  categorias/eliminar/confirmar/[id]
                    if(isset($params[2])){
                        if($params[2] == "confirmar"){
                            if(isset($params[3])){
                                $this->showConfirmation($params[3]);
                            }
                            else{
                                header("Location: " . BASE_URL . "categorias/administrar");
                            }     
                        }
                        else{
                            $this->removeCategory($params[2]);
                        }
                    }
                    else{
                        header("Location: " . BASE_URL . "categorias/administrar");
                    }
                    break;
                default:
                    $this->showCategory($params[1]);
                    break;
            }
        } else {
            header("Location: " . BASE_URL . "inicio");
        }
    }

    public function showCategory($id)
    {
        $categories = $this->model->getAll();
        print_r($id);
        // print_r($categories);
        
        //filtra el array de categorias, lo convierte en un array de ids
        $arrayId = array_column($categories, 'id');
        
        // print_r($arrayId);
        //busca el id pasado en el array de ids y devuelve la posicion
        $category = $categories[array_search($id, $arrayId)];
        
        print_r($category);    
        // die();

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
