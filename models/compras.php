<?php
require_once "connection.php";

class Compras{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    public function registrar(){
    }

}
?>