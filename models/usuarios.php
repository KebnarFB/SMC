<?php
require_once "connection.php";

class Usuarios{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this -> pdo = $conexion -> pdo;
    }

    public function roles(){
        $sql = "SELECT id_Rol, name_rol FROM roles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);      
    }

    public function registro($nombre, $usuario, $correo, $password, $id_rol){
        try{
            $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombres, username, correo, contrasena, idRol) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute([$nombre, $usuario, $correo, $pwd_hash, $id_rol]);
            return true;
        }catch(PDOexception $e){
            return false;
        }
    }

    public function login($usuario, $password){
        $sql = "SELECT id_user, nombres, username, correo, contrasena, descripcion, idRol FROM usuarios 
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

    public function updateProfile($id_user, $nombres,  $username, $email, $profile_image, $descripcion, $id_empresa){
        $sql = "UPDATE usuarios SET nombres=?, username=?, correo=?, img_perfil=?, descripcion=?, id_empresa = ? WHERE id_user=?";
        $stmt = $this -> pdo -> prepare($sql);

        $id_company = NULL;
        if (!empty($id_empresa)) {
            $id_company = (int)$id_empresa; 
        }
        return $stmt->execute([
            $nombres,         
            $username,      
            $email,            
            $profile_image,    
            $descripcion,
            $id_company,
            $id_user       
        ]);
    }

    public function getProfileImage($id_user){
        $sql = "SELECT img_perfil FROM usuarios WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn(); 
    }

    //Tab 1 - Obtener datos de usuarios
    public function obtenerUsuarios($username_excluido) {
        $sql = "SELECT id_user, nombres, username, correo, img_perfil, descripcion
                FROM usuarios  WHERE id_user != ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username_excluido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // TAB3
    public function obtenerDatosTab3() {
        $sql = "SELECT * FROM usuarios"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // TAB3 - Obtener recomendaciones
    public function obtenerRecomendaciones() {
        $sql = "SELECT id_user , nombres , decripcion, img_perfil
                FROM clientes";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
} 

?>
