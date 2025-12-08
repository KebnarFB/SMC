<?php 
require_once __DIR__ . "/../models/usuarios.php";

class userController{
    private $userModel;

    public function __construct(\Conexion $conexion){
        $this->userModel = new Usuarios;
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if(isset($_POST['action']) && $_POST['action'] === 'update_profile'){
                $this->click_UpdateProfile($_SESSION['id_user']);
            }
            else if(isset($_POST['username']) && isset($_POST['correo'])){
                $this->click_Registrar();
            }else if(isset($_POST['usuario']) && isset($_POST['pwd'])){
                $this->click_Login();
            }else if(isset($_POST['delete_account'])){
                $this->click_DeleteAccount($_SESSION['id_user']);
            }
        }
        header("Location: index.php?page=login");
    }

    public function click_Registrar(){
        $nombre = $_POST['nombres'];
        $usuario = $_POST['username'];
        $correo = $_POST['correo'];
        $pwd = $_POST['pwd'];
        $confirm_pwd = $_POST['pwd_confirm'];

        if($confirm_pwd !== $pwd) {
            http_response_code(400);
            echo "Las contraseñas no coinciden.";
            exit;
        }else {
            $registro = $this->userModel->registro($nombre, $usuario, $correo, $pwd);
            
            if ($registro) {
                // Éxito:
                echo "Tu cuenta ha sido creada exitosamente.";
                exit;
            } else {
                // Error de base de datos
                http_response_code(500);
                echo "No se pudo crear tu cuenta. </br> Intenta con otro nombre de usuario/correo.";
                exit;
            }
        }
    }

    public function click_Login(){
        $usuario_ingresado = $_POST['usuario'];
        $contrasena_plana = $_POST['pwd'];

        $datos_usuarios = $this->userModel->login($usuario_ingresado, $contrasena_plana);

        if ($datos_usuarios) {
            $_SESSION['id_user'] = $datos_usuarios['id_user'];
            $_SESSION['username'] = $datos_usuarios['username'];
            $_SESSION['loggedin'] = TRUE;

            $id_user = $datos_usuarios['id_user'];
            $profile_image_path = $this->userModel->getProfileImage($id_user);
            
            // Usar la ruta de la DB o un valor por defecto
            $_SESSION['img_perfil'] = $profile_image_path ?? 'views/assets/uploads/profile.png';
            
            header("Location: index.php?page=principal");
            exit();
        } else {
            header("Location: index.php?page=user&error=1");
            exit();
        }
    }

    public function click_DeleteAccount($id_user){
        $delete = $this->userModel->deleteAccount($id_user);
        if($delete){
            session_destroy();
            header("Location: index.php?page=home");
            exit();
        }else{
            http_response_code(500);
            echo "No se pudo eliminar la cuenta. Intenta nuevamente.";
            exit();
        }
    }

    public function click_UpdateProfile($id_user) {
        $username = $_POST['username'];
        $nombres = $_POST['nombres'];
        $email = $_POST['correo'];
        $descripcion = $_POST['descripcion'] ?? null;
        
        $profile_image = $_SESSION['img_perfil'] ?? '/SMC/views/assets/uploads/profile.png';
        
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            
            $file_tmp = $_FILES['profile_image']['tmp_name'];
            $file_name = $_FILES['profile_image']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            $new_file_name = "perfil_" . $id_user . "." . $file_ext;
            $upload_dir = __DIR__ . "/../views/assets/uploads/"; 
            
            $upload_path = $upload_dir . $new_file_name;
            $db_path = "views/assets/uploads/" . $new_file_name; 

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $profile_image = $db_path;
            }
        }

        $update = $this->userModel->updateProfile(
            $id_user,          
            $nombres,         
            $username,
            $email,
            $profile_image,
            $descripcion
        );

        if ($update) {
            $_SESSION['username'] = $username;
            $_SESSION['nombres'] = $nombres;   
            $_SESSION['correo'] = $email;
            $_SESSION['img_perfil'] = $profile_image;
            
            header("Location: index.php?page=principal&status=success");
            exit();
        } else {
            header("Location: index.php?page=principal&status=error");
            exit();
        }
    }
}
?>