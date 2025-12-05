<?php
require_once "connection.php";
session_start();
class Usuarios{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this -> pdo = $conexion -> pdo;
    }

    public function registro($nombre, $usuario, $correo, $password){
        try{
            $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombres, username, correo, contrasena) VALUES (?, ?, ?, ?)";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute([$nombre, $usuario, $correo, $pwd_hash]);
            return true;
        }catch(PDOexception $e){
            return false;
        }
    }

    public function login($usuario, $password){
        $sql = "SELECT id_cliente, username, contrasena FROM usuarios 
                WHERE username = ? ";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> execute([$usuario]);

        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($row){
            $hash = $row['contrasena'];

            if(password_verify($password, $hash)){
                return $row;
            }
        }
        return false;
    }
}
?>
