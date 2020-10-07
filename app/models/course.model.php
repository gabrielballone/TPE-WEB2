<?php

class CourseModel
{

    private $db;

    function __construct()
    {
        $this->db = $this->connect();
    }

    /**
     * Abre conexión a la base de datos
     */
    private function connect()
    {
        $db = new PDO('mysql:host=localhost;' . 'dbname=db_cursandoonline;charset=utf8', 'root', '');
        return $db;
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
     * Devuelve todos los cursos de la categoria pasada por parametro
     */
    function getCoursesByCategory($id_categoria)
    {
        $query = $this->db->prepare('SELECT * FROM curso WHERE id_categoria=?');
        $query->execute([$id_categoria]);
        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }

    /**
     * Inserta el curso en la base de datos, retorna el ID que se asigno
     */
    function insert($nombre, $descripcion, $duracion, $precio, $id_categoria)
    {
        $query = $this->db->prepare('INSERT INTO curso (nombre, descripcion, duracion, precio, id_categoria) VALUES (?,?,?,?,?)');
        $success = $query->execute([$nombre, $descripcion, $duracion, $precio, $id_categoria]);
        return $success;
    }

    /**
     * Actualiza el curso con el id pasado por parametro en la base de datos
     */
    function update($id, $nombre, $descripcion, $duracion, $precio, $id_categoria)
    {
        $query = $this->db->prepare('UPDATE curso SET nombre = ?, descripcion = ?, duracion = ?, precio = ?, id_categoria = ? WHERE id = ?');
        $success = $query->execute([$nombre, $descripcion, $duracion, $precio, $id_categoria, $id]);
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
