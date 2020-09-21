<?php
require_once 'libs/Smarty.class.php';

class CourseView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showCourses($courses, $categories) {
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categories', $categories);
        // $this->smarty->debugging = true;

        $this->smarty->display('templates/courses.tpl');
    }

    function showCourse($course, $categories) {
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categories', $categories);

        $this->smarty->display('templates/courses_id.tpl');
    }

}