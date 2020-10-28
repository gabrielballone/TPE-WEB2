<?php

class DbHelper
{
    public function __construct()
    {
    }

    /**
     * Abre y retorna conexión a la base de datos
     */
    public function connect()
    {
        $db = new PDO('mysql:host=localhost;' . 'dbname=db_cursandoonline;charset=utf8', 'root', '');
        return $db;
    }
}
