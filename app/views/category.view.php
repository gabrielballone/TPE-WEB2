<?php
require_once 'libs/Smarty.class.php';

class CategoryView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    // function showCategories($categories) {
    //     $this->smarty->assign('categories', $categories);
    //     $this->smarty->display('templates/categories_all.tpl');
    // }

    function showCategory($categories, $courses, $category) {
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categoryToShow', $category);
        $this->smarty->display('templates/category_one.tpl');
    }

}