<?php

class UserModel
{

    private $db;

    function __construct()
    {
        $this->db = $this->connect();
    }

    private function connect()
    {
        $db = new PDO('mysql:host=localhost;' . 'dbname=db_cursandoonline;charset=utf8', 'root', '');
        return $db;
    }


    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de usuarios

        return $usuarios;
    }

  
    function getUser($id)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id = ?');
        $query->execute([$id]);

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $usuario = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de usuarios

        return $usuario;
    }

    function exist($email)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $usuario = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de usuarios
        
        return count($usuario) != 0;
    }


    
    function insert($email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('INSERT INTO usuario (email, pass, nombre, telefono, administrador) VALUES (?,?,?,?,0)');
        $query->execute([$email, $password, $nombre, $telefono]);

        // 3. Obtengo y devuelo el ID del categoria nuevo
        return $this->db->lastInsertId();
    }

    
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM usuario WHERE id = ?');
        $query->execute([$id]);
    }

    /**
     * Actualiza el usuario con el id por parametro en la base de datos
     */
    function update($id, $email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('UPDATE usuario SET email = ?, password = ?, nombre = ?, telefono = ? WHERE id = ?');
        $query->execute([$email, $password, $nombre, $telefono, $id]);
    }
}
