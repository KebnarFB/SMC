<?php
require_once "connection.php";

class Empresas {
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    public function getEmpresas(){
        $sql = "SELECT * FROM empresas";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarEmpresa($id){
        $sql = "DELETE FROM empresas WHERE id_empresa = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function actualizarEmpresa($id, $nombre, $correo, $telefono){
        $sql = "UPDATE empresas SET nombre = ?, correo = ?, telefono = ? WHERE id_empresa = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $correo, $telefono, $id]);
    }
}
