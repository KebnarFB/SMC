<?php
require_once "connection.php";

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
        $sql = "SELECT id_user, username, contrasena FROM usuarios 
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

    public function deleteAccount($id_user){
        $sql = "DELETE FROM usuarios WHERE id_user=?";
        $stmt = $this -> pdo -> prepare($sql);
        return $stmt -> execute([$id_user]);
    }

    public function updateProfile($id_user, $nombres,  $username, $email, $profile_image, $descripcion){
        $sql = "UPDATE usuarios SET nombres=?, username=?, correo=?, img_perfil=?, descripcion=? WHERE id_user=?";
        $stmt = $this -> pdo -> prepare($sql);
        return $stmt->execute([
            $nombres,         
            $username,      
            $email,            
            $profile_image,    
            $descripcion,
            $id_user       
        ]);
    }

    public function getProfileImage($id_user){
        $sql = "SELECT img_perfil FROM usuarios WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn(); 
    }

    // TAB2 - Obtener clientes
public function obtenerRecomendaciones() {
    $sql = "SELECT nombres, username, correo, img_perfil, descripcion
            FROM usuarios";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // TAB3
    public function obtenerDatosTab3() {
        $sql = "SELECT * FROM usuarios"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //tab2 - Obtener todos los clientes
    public function getClientes() {
    $sql = "SELECT * FROM clientes";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
} 

?>
