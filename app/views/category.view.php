<?php
require_once 'libs/Smarty.class.php';

class CategoryView {
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign('BASE_URL', BASE_URL);
    }

    function showCategory($categories, $courses, $category) {
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categoryToShow', $category);
        $this->smarty->display('templates/category_one.tpl');
    }

    function showManageCategories($categories, $category=false){
        $this->smarty->assign('arrayEntity', $categories);
        $this->smarty->assign('objectEntity', $category);
        // $this->smarty->assign('category', $category);
        $this->smarty->assign('title', "Categorias");
        $this->smarty->assign('entityName', "categorias");
        $this->smarty->display('templates/manage.tpl');
    }

}