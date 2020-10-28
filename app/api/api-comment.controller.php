<?php
require_once 'app/models/comment.model.php';
require_once 'app/api/api.view.php';
require_once 'app/helpers/auth.helper.php';

class ApiCommentController
{

    private $model;
    private $view;
    private $helper;

    function __construct()
    {
        $this->model = new CommentModel();
        $this->view = new APIView();
        $this->helper = new AuthHelper();
        $this->data = file_get_contents("php://input");
    }

    // Lee la variable asociada a la entrada estandar y la convierte en JSON
    function getData()
    {
        return json_decode($this->data);
    }
    /**
     * Funcion auxiliar para validar la entrada recibida.
     */
    function checkInput($body)
    {
        if (!isset($body->contenido) || !is_string($body->contenido) || !(strlen($body->contenido) > 0) || !(strlen($body->contenido) < 255)) {
            return false;
        }
        if (!isset($body->puntuacion) || !is_numeric($body->puntuacion) || !($body->puntuacion > 0) || !($body->puntuacion <= 5)) {
            return false;
        }
        if (!isset($body->id_curso) || !is_numeric($body->id_curso)) { //Solo se verifica que sea numerico pero La DB no guarda si no es un indice válido 
            return false;
        }
        // if (!isset($body->id_usuario) || !is_numeric($body->id_usuario)) { //Solo se verifica que sea numerico pero La DB no guarda si no es un indice válido 
        //     return false;
        // }
        return true;
    }

    /**
     * Manda a obtener TODOS los comentarios.
     */
    public function getAll($params = null)
    {
        $parameters = [];

        if (isset($_GET['sort'])) {
            $parameters['sort'] = $_GET['sort'];
        }

        if (isset($_GET['order'])) {
            $parameters['order'] = $_GET['order'];
        }

        $comments = $this->model->getAll($parameters);
        $this->view->response($comments, 200);
    }
    /**
     * Manda a obtener los comentarios de un curso según el ID indicado en la URL
     */
    public function get($params = null)
    {
        // $params es un array asociativo con los parámetros de la ruta
        $idCourse = $params[':ID'];
        $comment = $this->model->getCommentsByCourse($idCourse);
        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("El curso con el id=$idCourse no tiene comentarios", 404);
    }
    /**
     * Manda a eliminar un comentario según la ID indicada en la URL
     */
    public function delete($params = null)
    {
        $idComment = $params[':ID'];
        $success = $this->model->remove($idComment);
        if ($success) {
            $this->view->response("El comentario con el id=$idComment se borró exitosamente", 200);
        } else {
            $this->view->response("El comentario con el id=$idComment no existe", 404);
        }
    }

    /**
     * Manda a insertar un comentario con los parametros recibidos en el POST (JSON).
     */
    public function add($params = null)
    {
        $body = $this->getData();
        $id = 0;
        if ($this->checkInput($body)) {
            $contenido   = $body->contenido;
            $puntuacion  = $body->puntuacion;
            $id_curso    = $body->id_curso;
            // $id_usuario  = $body->id_usuario;
            $id_usuario = $this->helper->getId(); 

            $id = $this->model->insert($contenido, $puntuacion, $id_usuario, $id_curso);
        }
        if ($id > 0) {
            $this->view->response("Se agrego el comentario con ID=$id exitosamente", 200);
        } else {
            $this->view->response("No se pudo insertar. Valores invalidos o faltan datos", 500);
            die();
        }
    }
    /**
     * Manda a actualizar un comentario con los parametros recibidos en el PUT (JSON).
     */
    public function update($params = null)
    {
        $idComment = $params[':ID'];
        $body = $this->getData();
        $id = 0;
        if ($this->checkInput($body)) {
            $contenido   = $body->contenido;
            $puntuacion  = $body->puntuacion;
            $id_usuario  = $body->id_usuario;
            $id_curso    = $body->id_curso;

            $id = $this->model->update($idComment, $contenido, $puntuacion, $id_usuario, $id_curso);
        }
        if ($id > 0) {
            $this->view->response("Se actualizó el comentario con ID=$id exitosamente", 200);
        } else {
            $this->view->response("No se pudo actualizar. Valores invalidos o faltan datos", 500);
            die();
        }
    }
}
