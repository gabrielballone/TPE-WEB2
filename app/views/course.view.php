<?php
require_once 'libs/Smarty.class.php';

class CourseView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    function showCourses($courses, $categories) {
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categories', $categories);
        // $this->smarty->debugging=true;

        $this->smarty->display('templates/courses_all.tpl');
    }

    function showCourse($course, $categories) {
        $this->smarty->assign('course', $course);
        $this->smarty->assign('categories', $categories);

        $this->smarty->display('templates/course_one.tpl');
    }

    function showManageCourses($courses, $categories=false, $course=false){
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('course', $course);
        $this->smarty->assign('entityName', "cursos");
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('templates/manage_courses.tpl');
    }

    function confirmCourseRemove($id, $name) {
        $this->smarty->assign('entityToRemove', "cursos");
        $this->smarty->assign('name', $name);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/confirmation_remove.tpl');
    }



}