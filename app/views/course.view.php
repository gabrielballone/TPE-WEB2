<?php
require_once 'libs/Smarty.class.php';

class CourseView
{
    private $smarty;
    /**
    * Se crea objeto Smarty y se asigna variable de URL base.
    */
    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }
    /**
     * Recibe como parametro array de cursos, array de categorias.
     */
    function showCourses($courses, $categories, $numPage, $amountPages, $datos, $amountCourses, $filter = null)
    {
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('numPage', $numPage);
        $this->smarty->assign('amountPages', $amountPages);
        $this->smarty->assign('amountCourses', $amountCourses);
        $this->smarty->assign('datos', $datos);
        if (isset($filter)) 
            $this->smarty->assign('filter', $filter . "&");
        else
            $this->smarty->assign('filter', $filter);

        $this->smarty->display('templates/courses_all.tpl');
    }
    /**
     * Recibe como parametro objeto curso y array de categorias.
     */
    function showCourse($course, $categories)
    {
        $this->smarty->assign('course', $course);
        $this->smarty->assign('categories', $categories);

        $this->smarty->display('templates/course_one.tpl');
    }
    /**
     * Recibe como parametro array de cursos y parametros opcionales array de categorias y objeto curso.
     */
    function showManageCourses($courses, $categories = false, $course = false)
    {
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('course', $course);
        $this->smarty->assign('entityName', "cursos");
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/manage_courses.tpl');
    }
    /**
     * Recibe como parametro id de curso a eliminar y nombre de curso a eliminar.
     */
    function confirmCourseRemove($id, $name)
    {
        $this->smarty->assign('entityToRemove', "cursos");
        $this->smarty->assign('name', $name);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/confirmation_remove.tpl');
    }
    /**
     * Recibe como parametro mensaje a mostrar en el error.
     */
    function showError($message)
    {
        $this->smarty->assign('messageError', $message);
        $this->smarty->assign('entityToRemove', "cursos");
        $this->smarty->display('templates/showError.tpl');
    }
    /**
     * Muestra mensaje de error 404.
     */
    function showError404()
    {
        $this->smarty->display('templates/error404.tpl');
    }
}
