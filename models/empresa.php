<?php
require_once "connection.php";

class Empresa{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    public function registrar($name_empresa, $comentarios){
        $sql = "INSERT INTO empresa(nombre_empresa, comentarios) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name_empresa, $comentarios]);
    }

    public function consultar(){
        $sql = "SELECT id_empresa, nombre_empresa FROM empresa";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar(){
        
    }

    public function eliminar(){
        
    }
}
?>