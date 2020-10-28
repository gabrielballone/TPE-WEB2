<?php
require_once 'app/helpers/db.helper.php';


class CategoryModel
{
    private $db;
    private $helper;

    function __construct()
    {
        $this->helper = new DbHelper();
        $this->db = $this->helper->connect();
    }

    /**
     * Devuelve todas las categorias de la base de datos.
     */
    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    /**
     * Devuelve la categoria con el id por parametro de la base de datos.
     */
    function getCategory($id)
    {
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id = ?');
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

    /**
     * Inserta la categoria en la base de datos, retorna el ID que se asigno
     */
    function insert($nombre, $descripcion)
    {
        $query = $this->db->prepare('INSERT INTO categoria (nombre, descripcion) VALUES (?,?)');
        $success = $query->execute([$nombre, $descripcion]);
        return $success;
    }

    /**
     * Actualiza la categoria con el id pasado por parametro en la base de datos
     */
    function update($id, $nombre, $descripcion)
    {
        $query = $this->db->prepare('UPDATE categoria SET nombre = ?, descripcion = ? WHERE id = ?');
        $success = $query->execute([$nombre, $descripcion, $id]);
        return $success;
    }

    /**
     * Elimina la categoria con el id pasado por parametro en la base de datos
     */
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM categoria WHERE id = ?');
        $query->execute([$id]);
    }
}
