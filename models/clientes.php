<?php
require_once "connection.php";

class Clientes{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    public function crear(){
    
    }

    public function consultar(){

    }

    public function actualizar(){
        
    }

    public function eliminar(){
        
    }
}
?>

