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
        if(isset($_GET['pagina']) && is_numeric($_GET['pagina']) && $_GET['pagina']>0){
            $numPage = $_GET['pagina'];
        }
        else
            $numPage = 1;
        $amountCourses = $this->model->getAmountCourses();
        $amountPages = ceil($amountCourses/4); //redondea a entero, hacia arriba
        $courses = $this->model->getAllInnerCategoryNameWithPagination($numPage);
        $categories = $this->modelCategory->getAll();
        $this->view->showCourses($courses, $categories, $numPage, $amountPages);
      
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
        $this->authHelper->checkUserIsManager($this->view);
        $courses = $this->model->getAllInnerCategoryName();
        $categories = $this->modelCategory->getAll();
        $this->view->showManageCourses($courses, $categories);
    }

    /**
     * Construye un nombre unico de archivo y ademas lo mueve a 
     * mi carpeta de imagenes
     */
    function uniqueSaveName($realName, $tempName)
    {

        $filePath = "images/user/" . uniqid("", true) . "."
            . strtolower(pathinfo($realName, PATHINFO_EXTENSION));

        move_uploaded_file($tempName, $filePath);

        return $filePath;
    }

    /**
     * Manda a crear curso con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function createCourse()
    {
        $this->authHelper->checkUserIsManager($this->view);
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];

        if (!empty($nombre) &&  !empty($descripcion) && !empty($precio) && !empty($duracion) && !empty($categoria)) {
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $pathImage = $this->uniqueSaveName($_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
                $success = $this->model->insert($nombre, $descripcion, $duracion, $precio, $categoria, $pathImage);
            } else {
                $success = $this->model->insert($nombre, $descripcion, $duracion, $precio, $categoria);
            }
            if ($success)
                header('Location: ' . BASE_URL . 'cursos/administrar');
            else
                $this->view->showError("Ya existe una curso con ese nombre!");
        } else
            $this->view->showError("Faltan datos. Por favor reintentalo.");
    }

    /**
     * Elimina una imagen del sistema de archivos si existe. Parametro id del curso.
     */
    public function deleteImageFromSystem($id)
    {
        $course = $this->model->getCourse($id);
        $path = $course->imagen;
        unlink($path);
    }

    /**
     * Manda a actualizar curso con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function updateCourse($id)
    {
        $this->authHelper->checkUserIsManager($this->view);
        
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['duracion']) && !empty($_POST['precio']) && !empty($_POST['categoria'])) {
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $pathImage = $this->uniqueSaveName($_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
                $this->deleteImageFromSystem($id);
                $success = $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria'], $pathImage);
            } else {
                if (isset($_POST['estadoImagen'])){
                    $deleteImage = $_POST['estadoImagen'];
                    $this->deleteImageFromSystem($id);
                    $success = $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria'], $deleteImage);                    
                } else {
                    $success = $this->model->update($id, $_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio'], $_POST['categoria']);
                }
            }
            if ($success)
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
        $this->authHelper->checkUserIsManager($this->view);
        $this->deleteImageFromSystem($id);
        $this->model->remove($id);
        header('Location: ' . BASE_URL . 'cursos/administrar');
    }
    /**
     * Manda a mostrar confirmación para eliminar curso si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function showConfirmation($id)
    {
        $this->authHelper->checkUserIsManager($this->view);
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
