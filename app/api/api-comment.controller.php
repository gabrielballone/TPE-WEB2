<?php
require_once 'app/models/comment.model.php';
require_once 'app/api/api.view.php';

class ApiCommentController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new CommentModel();
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }

    // Lee la variable asociada a la entrada estandar y la convierte en JSON
    function getData(){ 
        return json_decode($this->data); 
    }
    function checkTypes($body) {
        if (!is_string($body->contenido) || !(strlen($body->contenido) > 0) || !(strlen($body->contenido) < 255)){
            return false;
        }
        if (!is_numeric($body->puntuacion) || !($body->puntuacion > 0) || !($body->puntuacion <= 5)){
            return false;
        }
        if (!is_numeric($body->id_usuario)){ //Solo se verifica que sea numerico pero La DB no guarda si no es un indice válido 
            return false;
        }
        if (!is_numeric($body->id_curso)){ //Solo se verifica que sea numerico pero La DB no guarda si no es un indice válido 
            return false;
        }
        return true;
    }

    public function getAll($params = null) {
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

    public function get($params = null) {
        // $params es un array asociativo con los parámetros de la ruta
        $idComment = $params[':ID'];
        $comment = $this->model->getComment($idComment);
        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("El comentario con el id=$idComment no existe", 404);
    }

    public function delete($params = null) {
        $idComment = $params[':ID'];
        $success = $this->model->remove($idComment);
        if ($success) {
            $this->view->response("La tarea con el id=$idComment se borró exitosamente", 200);
        }
        else { 
            $this->view->response("La tarea con el id=$idComment no existe", 404);
        }
    }

    public function add($params = null) {
        $body = $this->getData();   

        if (isset($body->contenido) &&
            isset($body->puntuacion) &&
            isset($body->id_usuario) &&
            isset($body->id_curso) &&
            $this->checkTypes($body)) {
                $contenido   = $body->contenido;
                $puntuacion  = $body->puntuacion;
                $id_usuario  = $body->id_usuario;
                $id_curso    = $body->id_curso;

                $id = $this->model->insert($contenido, $puntuacion, $id_usuario,$id_curso);            
        }
        else
        {
            $this->view->response("No se pudo insertar. Valores invalidos o faltan datos", 500);
            die();
        }
        // else
        // {
        //     $this->view->response("No se pudo insertar. Faltan datos", 500);
        //     die();
        // }

        if ($id > 0) {
            $this->view->response("Se agrego el comentario con ID=$id exitosamente", 200);
        }
        else { 
            $this->view->response("No se pudo insertar el comentario", 500);
        }
    }
    

    // public function update($params = null) {
    //     $idTask = $params[':ID'];
    //     $body = $this->getData();

    //     $titulo       = $body->titulo;
    //     $descripcion  = $body->descripcion;
    //     $prioridad    = $body->prioridad;

    //     $success = $this->model->update($titulo, $descripcion, $prioridad, $idTask);

    //     if ($success) {
    //         $this->view->response("Se actualizó la tarea $idTask exitosamente", 200);
    //     }
    //     else { 
    //         $this->view->response("No se pudo actualizar", 500);
    //     }
    // }

}