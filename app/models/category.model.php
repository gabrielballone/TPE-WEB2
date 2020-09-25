<?php

class CategoryModel {

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
     * Devuelve todas las categorias de la base de datos.
     */
    function getAll() {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $categoria = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de categorias

        return $categoria;
    }

    /**
     * Devuelve la categoria con el id por parametro de la base de datos.
     */
    function getCategory($id) { 
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id = ?');
        $query->execute([$id]);

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $categoria = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de categorias

        return $categoria[0];
    }
    

    /**
     * Inserta la categoria en la base de datos
     */
    function insert($nombre, $descripcion) {
        $query = $this->db->prepare('INSERT INTO categoria (nombre, descripcion) VALUES (?,?)');
        $query->execute([$nombre, $descripcion]);

        // 3. Obtengo y devuelo el ID del categoria nuevo
        return $this->db->lastInsertId();
    }

    /**
     * Elimina la categoria con el id por parametro en la base de datos
     */
    function remove($id) { 
        $query = $this->db->prepare('DELETE FROM categoria WHERE id = ?');
        $query->execute([$id]);
    }
    
    /**
     * Actualiza la categoria con el id por parametro en la base de datos
     */
    function update($id, $nombre, $descripcion){ 
        $query = $this->db->prepare('UPDATE categoria SET nombre = ?, descripcion = ? WHERE id = ?');
        $query->execute([$nombre, $descripcion, $id]);
    }
}