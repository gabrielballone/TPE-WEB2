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
        $usuario = $query->fetch(PDO::FETCH_OBJ); // arreglo de usuarios

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

    function checkLogin($email, $pass){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE email = ?');
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ); 
    
        if ($user != null) {
            $comprobacion = password_verify($pass, $user->pass);

            if ($comprobacion) {
                session_start();
                $_SESSION['email'] = $user->email;
                $_SESSION['id'] = $user->id;
                $_SESSION['administrador'] = $user->administrador;
            }

            return $comprobacion;
        } else {
            return false;
        }




    }

    function insert($email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('INSERT INTO usuario (email, pass, nombre, telefono, administrador) VALUES (?,?,?,?,0)');
        $query->execute([$email, $password, $nombre, $telefono]);

        // 3. Obtengo y devuelo el ID del categoria nuevo
        return $this->db->lastInsertId();
    }
    
    function update($id, $email, $password, $nombre, $telefono)
    {
        $query = $this->db->prepare('UPDATE usuario SET email = ?, pass = ?, nombre = ?, telefono = ? WHERE id = ?');
        $query->execute([$email, $password, $nombre, $telefono, $id]);
    }

    function setAdministrador($id, $administrador){
        $query = $this->db->prepare('UPDATE usuario SET administrador=? WHERE id = ?');
        $query->execute([$administrador, $id]);
    }
    
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM usuario WHERE id = ?');
        $query->execute([$id]);
    }

}
