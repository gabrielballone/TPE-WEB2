<?php
require_once 'app/helpers/db.helper.php';

class UserModel
{
    
    private $db;
    private $helper;

    function __construct()
    {
        $this->helper = new DbHelper();
        $this->db = $this->helper->connect();
    }

    /**
     * Devuelve todos los usuarios de la base de datos.
     */
    function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        //Obtengo la respuesta con un fetchAll (porque son muchos)
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ); // arreglo de usuarios

        return $usuarios;
    }

    /**
     * Devuelve el usuario con el id pasado por parametro de la base de datos.
     */
    function getUser($id)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id = ?');
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    /**
     * Devuelve el usuario con el email pasado por parametro de la base de datos.
     */
    function getUserByEmail($email)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
    /**
     * Devuelve TRUE si el email pasado por parametro ya existe en la base de datos.
     */
    function exist($email)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    /**
     * Inserta el usuario pasado por parametro en la base de datos, retorna el ID que se asigno
     */
    function insert($email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('INSERT INTO usuario (email, password, nombre, telefono, administrador) VALUES (?,?,?,?,0)');
        $query->execute([$email, $password, $nombre, $telefono]);
        return $this->db->lastInsertId();
    }

    /**
     * Actualiza el usuario con el id pasado por parametro en la base de datos
     */
    function update($id, $email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('UPDATE usuario SET email = ?, password = ?, nombre = ?, telefono = ? WHERE id = ?');
        $success = $query->execute([$email, $password, $nombre, $telefono, $id]);
        return $success;
    }

    /**
     * Elimina el usuario con el id pasado por parametro en la base de datos
     */
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM usuario WHERE id = ?');
        $query->execute([$id]);
    }

    /**
     * Setea la columna administrador con el valor pasado por parametro(0/1) en la base de datos
     */
    function setAdministrador($id, $administrador)
    {
        $query = $this->db->prepare('UPDATE usuario SET administrador=? WHERE id = ?');
        $query->execute([$administrador, $id]);
    }
}
