<?php

class CourseModel {

    private $db;

    function __construct() {
         // 1. Abro la conexión
        $this->db = $this->connect();
    }

    /**
     * Abre conexión a la base de datos;
     */
    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_cursandoonline;charset=utf8', 'root', '');
        return $db;
    }

    /**
     * Devuelve todos los cursos de la base de datos.
     */
    function getAll() {
        $query = $this->db->prepare('SELECT * FROM curso');
        $query->execute();

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $cursos = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de cursos

        return $cursos;
    }

    function getAllInnerCategoyName() {
        $query = $this->db->prepare('SELECT curso.*, categoria.nombre AS nombre_categoria FROM curso INNER JOIN categoria ON curso.id_categoria = categoria.id');
        $query->execute();

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $cursos = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de cursos

        return $cursos;
    }

    /**
     * Devuelve el curso con el id por parametro de la base de datos
     */
    function getCourse($id) { 
        $query = $this->db->prepare('SELECT * FROM curso WHERE id = ?');
        $query->execute([$id]);

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $curso = $query->fetch(PDO::FETCH_OBJ); // arreglo de cursos

        return $curso; 
    }
    /**
     * Devuelve los cursos de la categoria pasada por parametro
     */
    function getCoursesByCategory($id_categoria) { 
        $query = $this->db->prepare('SELECT * FROM curso WHERE id_categoria=?');
        $query->execute([$id_categoria]);
        
        $curso = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de cursos por categoria

        return $curso;
    }

    /**
     * Inserta el curso en la base de datos
     */
    function insert($nombre, $descripcion, $duracion, $precio, $id_categoria) {
        $query = $this->db->prepare('INSERT INTO curso (nombre, descripcion, duracion, precio, id_categoria) VALUES (?,?,?,?,?)');
        $query->execute([$nombre, $descripcion, $duracion, $precio, $id_categoria]);

        // 3. Obtengo y devuelo el ID del curso nuevo
        return $this->db->lastInsertId();
    }

    /**
     * Elimina el curso con el id por parametro en la base de datos
     */
    function remove($id) { 
        $query = $this->db->prepare('DELETE FROM curso WHERE id = ?');
        $query->execute([$id]);
    }
    
    function update($id, $nombre, $descripcion, $duracion, $precio, $id_categoria){ 
        $query = $this->db->prepare('UPDATE curso SET nombre = ?, descripcion = ?, duracion = ?, precio = ?, id_categoria = ? WHERE id = ?');
        $query->execute([$nombre, $descripcion, $duracion, $precio, $id_categoria, $id]);
    }
}