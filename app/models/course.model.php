<?php
require_once 'app/helpers/db.helper.php';

class CourseModel
{
    private $db;
    private $helper;

    function __construct()
    {
        $this->helper = new DbHelper();
        $this->db = $this->helper->connect();
    }

    /**
     * Devuelve todos los cursos de la base de datos.
     */
    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM curso');
        $query->execute();
        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }

    /**
     * Devuelve todas las columnas de la tabla curso ensambladas con el nombre del id_categoria de la tabla categoria
     */
    function getAllInnerCategoryName()
    {
        $query = $this->db->prepare('SELECT curso.*, categoria.nombre AS nombre_categoria FROM curso INNER JOIN categoria ON curso.id_categoria = categoria.id ORDER BY curso.id_categoria');
        $query->execute();
        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }

    /**
     * Devuelve el curso con el id pasado por parametro de la base de datos
     */
    function getCourse($id)
    {
        $query = $this->db->prepare('SELECT * FROM curso WHERE id = ?');
        $query->execute([$id]);
        $course = $query->fetch(PDO::FETCH_OBJ);
        return $course;
    }

    /**
     * Devuelve todas las columnas de la tabla curso ensambladas con el nombre del id_categoria de la tabla categoria
     */
    function getCourseInnerCategoryName($id)
    {
        $query = $this->db->prepare('SELECT curso.*, categoria.nombre as categoria_nombre FROM curso INNER JOIN categoria on curso.id_categoria=categoria.id WHERE curso.id =?');
        $query->execute([$id]);
        $course = $query->fetch(PDO::FETCH_OBJ);
        return $course;
    }

    /**
     * Devuelve la cantidad de cursos de la categoria pasada por parametro
     */
    function getAmountCoursesByCategory($id_categoria){
        $query = $this->db->prepare('SELECT count(id) AS amount FROM `curso` WHERE id_categoria=?');
        $query->execute([$id_categoria]);
        $amount = $query->fetch(PDO::FETCH_OBJ);//amount es un objeto del tipo amount={amount : "4"}
        return $amount->amount;
    }

    /**
     * Devuelve todos los cursos de la categoria pasada por parametro
     */
    function getCoursesByCategory($id_categoria, $page)
    {
        $page--; //si mando pagina 1 como param quiero que se vea el LIMIT 0,4
        $page*=4; //si mando pagina 2 como param (hago 1*4) quiero que se vea LIMIT 4,4 
        $query = $this->db->prepare('SELECT * FROM curso WHERE id_categoria=:id LIMIT :page,4');
        $query->bindParam(":id", $id_categoria, PDO::PARAM_INT);
        $query->bindParam(":page", $page, PDO::PARAM_INT);
        $query->execute();
        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }

    /**
     * Inserta el curso en la base de datos, retorna el ID que se asigno
     */
    function insert($nombre, $descripcion, $duracion, $precio, $id_categoria, $imagen = null)
    {
        $query = $this->db->prepare('INSERT INTO curso (nombre, descripcion, duracion, precio, id_categoria, imagen) VALUES (?,?,?,?,?,?)');
        $success = $query->execute([$nombre, $descripcion, $duracion, $precio, $id_categoria, $imagen]);
        return $success;
    }

    /**
     * Actualiza el curso con el id pasado por parametro en la base de datos
     */
    function update($id, $nombre, $descripcion, $duracion, $precio, $id_categoria, $imagen = null)
    {
        if ($imagen) {
            $sql = 'UPDATE curso SET nombre = ?, descripcion = ?, duracion = ?, precio = ?, id_categoria = ?, imagen = ? WHERE id = ?';
            $params = [$nombre, $descripcion, $duracion, $precio, $id_categoria, $imagen, $id];
        } else {
            $sql = 'UPDATE curso SET nombre = ?, descripcion = ?, duracion = ?, precio = ?, id_categoria = ? WHERE id = ?';
            $params = [$nombre, $descripcion, $duracion, $precio, $id_categoria, $id];
        }
        $query = $this->db->prepare($sql);
        $success = $query->execute($params);
        return $success;
    }

    /**
     * Elimina el curso con el id pasado por parametro en la base de datos
     */
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM curso WHERE id = ?');
        $query->execute([$id]);
    }
}
