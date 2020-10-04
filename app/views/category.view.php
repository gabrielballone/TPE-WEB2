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
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('category', $category);
        $this->smarty->display('templates/manage_categories.tpl');
    }

    function confirmCategoryRemove($id, $name) {
        $this->smarty->assign('entityToRemove', "categorias");
        $this->smarty->assign('name', $name);
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/confirmation_remove.tpl');
    }

    function showError($message){
        $this->smarty->assign('messageError', $message);
        $this->smarty->assign('entityToRemove', "categorias");
        $this->smarty->display('templates/showError.tpl');
    }

    function showErrorId($message){
        $this->smarty->assign('messageError', $message);
        $this->smarty->display('templates/error.tpl');
    }

}