<?php

class CommentModel
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
     * Devuelve todos los comentarios de la base de datos.
     */
    function getAll($parametros = null)
    {
        $sql = 'SELECT * FROM comentario';

        if (isset($parametros['order'])) {
            $sql .= ' ORDER BY '.$parametros['order'];

            if (isset($parametros['sort'])) {
                $sql .= ' '.$parametros['sort'];
            }
    
        }
        // 2. Enviar la consulta (2 sub-pasos: prepare y execute)
        $query = $this->db->prepare($sql);
        $query->execute();

        // 3. Obtengo la respuesta con un fetchAll (porque son muchos) 
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    /**
     * Devuelve todas las columnas de la tabla comentarios ensambladas con el nombre del id_usuario de la tabla usuario
     */
    // function getAllInnerUserName()
    // {
    //     $query = $this->db->prepare('SELECT comentario.*, usuario.nombre AS nombre_usuario FROM comentario INNER JOIN usuario ON comentario.id_usuario = usuario.id ORDER BY comentario.id_usuario');
    //     $query->execute();
    //     $comments = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $comments;
    // }

    /**
     * Devuelve el comentario con el id pasado por parametro de la base de datos
     */
    function getComment($id)
    {
        $query = $this->db->prepare('SELECT * FROM comentario WHERE id = ?');
        $query->execute([$id]);
        $comments = $query->fetch(PDO::FETCH_OBJ);
        return $comments;
    }

    /**
     * Devuelve todas las columnas de la tabla curso ensambladas con el nombre del id_categoria de la tabla categoria
     */
    // function getCommentInnerCategoryName($id)
    // {
    //     $query = $this->db->prepare('SELECT curso.*, categoria.nombre as categoria_nombre FROM curso INNER JOIN categoria on curso.id_categoria=categoria.id WHERE curso.id =?');
    //     $query->execute([$id]);
    //     $course = $query->fetch(PDO::FETCH_OBJ);
    //     return $course;
    // }

    /**
     * Devuelve todos los cursos de la categoria pasada por parametro
     */
    function getCommentsByCourse($id_course)
    {
        $query = $this->db->prepare('SELECT * FROM comentario WHERE id_curso=?');
        $query->execute([$id_course]);
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    /**
     * Inserta el comentario en la base de datos, retorna el ID que se asigno
     */
    function insert($contenido, $puntuacion, $id_usuario, $id_curso)
    {
        $query = $this->db->prepare('INSERT INTO comentario (contenido, puntuacion, id_usuario, id_curso) VALUES (?,?,?,?)');
        $query->execute([$contenido, $puntuacion, $id_usuario, $id_curso]);
        return $this->db->lastInsertId();
    }

    /**
     * Actualiza el comentario con el id pasado por parametro en la base de datos
     */
    function update($id, $contenido, $puntuacion, $id_usuario, $id_curso)
    {
        $query = $this->db->prepare('UPDATE comentario SET contenido = ?, puntuacion = ?, id_usuario = ?, id_curso = ? WHERE id = ?');
        $success = $query->execute([$contenido, $puntuacion, $id_usuario, $id_curso, $id]);
        return $success;
    }

    /**
     * Elimina el comentario con el id pasado por parametro en la base de datos
     */
    function remove($id)
    {
        $query = $this->db->prepare('DELETE FROM comentario WHERE id = ?');
        $success = $query->execute([$id]);
        return $success;
    }
}
