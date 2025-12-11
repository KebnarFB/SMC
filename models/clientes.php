<?php
require_once "connection.php";

class Clientes{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    public function crearCliente($id_empresa, $nombre_cliente, $telefono, $correo, $dirreccion){
        try{
            $sql = "INSERT INTO clientes(id_empresa, nombre_cliente, telefono, correo, direccion) VALUES(?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_empresa, $nombre_cliente, $telefono, $correo, $dirreccion]);
            return true;
        }catch(PDOexception $e){
            return false;
        }
    }

    //tab2 - Obtener todos los clientes
    public function consultarClientes() {
        $sql = "SELECT nombre_cliente, telefono, correo , id_empresa FROM clientes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

