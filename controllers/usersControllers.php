<?php 
require_once "../models/usuarios.php";
$user = new Usuarios();
$error_login = false;
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['username'])) { 
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
            $registro = $user->registro($nombre, $usuario, $correo, $pwd);
            
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
    }else if( isset($_POST['usuario']) && isset($_POST['pwd']) ){
    
        $usuario_ingresado = $_POST['usuario'];
        $contrasena_plana = $_POST['pwd'];

        $datos_usuarios = $user -> login($usuario_ingresado, $contrasena_plana);

        // Verificar si se encontró un usuario con ese nombre
        if ($datos_usuarios) {
            $_SESSION['id_cliente'] = $datos_usuarios['id_cliente'];
            $_SESSION['username'] = $datos_usuarios['username'];
            $_SESSION['loggedin'] = TRUE;
            
            header("Location: ../views/pages/Principal.php");
            exit();
        } else {
            $error_login = true;
        }
    }
}


?>