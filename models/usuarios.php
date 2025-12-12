<?php
require_once "connection.php";

class Usuarios {
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo;
    }

    // Permitir al controlador acceder al PDO
    public function getPDO() {
        return $this->pdo;
    }

    /* ROLES*/
    public function roles(){
        $sql = "SELECT id_Rol, name_rol FROM roles";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*REGISTRO*/
    public function registro($nombre, $usuario, $correo, $password, $id_rol){
        try {
            $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombres, username, correo, contrasena, idRol)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nombre, $usuario, $correo, $pwd_hash, $id_rol]);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

    /*LOGIN*/
    public function login($usuario, $password){
        $sql = "SELECT id_user, nombres, username, correo, contrasena, descripcion, idRol, id_empresa, img_perfil
                FROM usuarios
                WHERE username = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['contrasena'])) {
            return $row;
        }

        return false;
    }

    /*ELIMINAR CUENTA*/
    public function deleteAccount($id_user){
        $sql = "DELETE FROM usuarios WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_user]);
    }

    /*ACTUALIZAR PERFIL */
    public function updateProfile($id_user, $nombres, $username, $email, $profile_image, $descripcion, $id_empresa){
        $sql = "UPDATE usuarios 
                SET nombres=?, username=?, correo=?, img_perfil=?, descripcion=?, id_empresa=?
                WHERE id_user=?";

        $stmt = $this->pdo->prepare($sql);

        $id_company = empty($id_empresa) ? NULL : (int)$id_empresa;

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

    /** OBTENER FOTO PERFIL*/
    public function getProfileImage($id_user){
        $sql = "SELECT img_perfil FROM usuarios WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn();
    }

    /* TAB 1 - LISTA DE USUARIOS */
    public function obtenerUsuarios($id_user_excluir){
        $sql = "SELECT id_user, nombres, username, correo, img_perfil, descripcion
                FROM usuarios
                WHERE id_user != ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user_excluir]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /*TAB 3 - RECOMENDACIONES*/
public function obtenerUsuariosPorLikes(){
    $sql = "SELECT u.*,
            (SELECT COUNT(*) FROM likes_usuarios l WHERE l.id_liked = u.id_user) AS total_likes
            FROM usuarios u
            ORDER BY total_likes DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
