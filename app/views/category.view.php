<?php
require_once 'libs/Smarty.class.php';

class CategoryView
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
     * Recibe como parametro array de categorias, array de cursos y objeto categoria.
     */
    function showCategory($categories, $courses, $category, $numPage, $amountPages)
    {
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('courses', $courses);
        $this->smarty->assign('categoryToShow', $category);
        $this->smarty->assign('numPage', $numPage);
        $this->smarty->assign('amountPages', $amountPages);
        $this->smarty->display('templates/category_one.tpl');
    }

    /**
     * Recibe como parametro array de categorias y parametro opcional objeto categoria.
     */
    function showManageCategories($categories, $category = false)
    {
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('category', $category);
        $this->smarty->display('templates/manage_categories.tpl');
    }

    /**
     * Recibe como parametro id de categoria a eliminar y nombre de categoria a eliminar.
     */
    function confirmCategoryRemove($id, $name)
    {
        $this->smarty->assign('entityToRemove', "categorias");
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
        $this->smarty->assign('entityToRemove', "categorias");
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
