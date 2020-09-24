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
                    $this->updateCategory($params[2]);
                    break;
                case "eliminar": //categorias/eliminar/[id]
                    $this->removeCategory($params[2]);
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
        if(isset($_POST['nombre'], $_POST['descripcion'])){
            $this->model->insert($_POST['nombre'], $_POST['descripcion']);
        }
    }

    public function updateCategory($id)
    {
        if(isset($_POST['nombre'], $_POST['descripcion'])){
            $this->model->insert($_POST['nombre'], $_POST['descripcion']);
        }
    }

    public function removeCategory($id)
    {
        $this->model->remove($id);
    }
}
