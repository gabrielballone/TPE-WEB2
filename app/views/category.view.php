<?php
require_once 'libs/Smarty.class.php';

class CategoryView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showCourses($courses) {
        $this->smarty->assign('courses', $courses);
        $this->smarty->display('templates/courses.tpl');
    }

    function showCourse($course) {
        $this->smarty->display('templates/courses.tpl');
    }

}