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
     * Obtiene todos los cursos segun el filtro aplicado con el nombre de categoría relacionado y manda a mostrar.
     * Filtros posibles: nombre, duracion, precio
     * Si no hay filtro muestra todos los cursos.
     * En todos los casos se muestra paginado de a 4
     */
    function showCourses()
    {
        $numPage = "1";
        $filter = null;
        $datos = array(
            "filtro" => null,
            "texto" => null,
            "min" => null,
            "max" => null,
        );
        if(isset($_GET['pagina']) && is_numeric($_GET['pagina']) && $_GET['pagina']>0){
            $numPage = $_GET['pagina'];
        }
        if(isset($_GET['filtro'])){
            switch ($_GET['filtro']) {
                case 'nombre':
                    if (isset($_GET['texto'])){
                        $filter = "filtro=nombre&texto=" . $_GET['texto'];
                        $datos['filtro'] = 'nombre';
                        $datos['texto'] = $_GET['texto'];
                        $amountCourses = $this->model->getAmountCoursesFilterByName($_GET['texto']);
                        $courses = $this->model->getCoursesFilterByName($_GET['texto'], $numPage);
                    }
                    else{
                        $courses = $this->model->getAllInnerCategoryName($numPage);
                        $amountCourses = $this->model->getAmountCourses();
                    }                    
                    break;
                case 'duracion':
                    $filter = "filtro=duracion";
                    $datos['filtro'] = 'duracion';
                    $min = 0;
                    $max = 0;
                    if (isset($_GET['min'])){
                        $min = $_GET['min'];
                        $filter = $filter . "&min=" . $min;
                        $datos['min'] = $_GET['min'];                        
                    }
                    if (isset($_GET['max'])){
                        $max = $_GET['max'];
                        $filter = $filter . "&max=" . $max;
                        $datos['max'] = $_GET['max']; 
                    }
                    $amountCourses = $this->model->getAmountCoursesFilterByDuracion($min, $max);
                    $courses = $this->model->getCoursesFilterByDuracion($min, $max, $numPage);                                        
                    break;
                case 'precio':
                    $filter = "filtro=precio";
                    $datos['filtro'] = 'precio';
                    $min = 0;
                    $max = 0;
                    if (isset($_GET['min'])){
                        $min = $_GET['min'];
                        $filter = $filter . "&min=" . $min;
                        $datos['min'] = $_GET['min'];
                    }                    
                    if (isset($_GET['max'])){
                        $max = $_GET['max'];
                        $filter = $filter . "&max=" . $max;
                        $datos['max'] = $_GET['max'];
                    }
                    $amountCourses = $this->model->getAmountCoursesFilterByPrecio($min, $max);
                    $courses = $this->model->getCoursesFilterByPrecio($min, $max, $numPage);                                        
                    break;
                default:
                    $courses = $this->model->getAllInnerCategoryName($numPage);
                    $amountCourses = $this->model->getAmountCourses();
                break;                
            } 
        } else {
            $courses = $this->model->getAllInnerCategoryName($numPage);
            $amountCourses = $this->model->getAmountCourses();
        }        
        $amountPages = ceil($amountCourses/4); //ceil redondea a entero, hacia arriba
        $categories = $this->modelCategory->getAll();
        $this->view->showCourses($courses, $categories, $numPage, $amountPages, $datos, $amountCourses, $filter);
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
