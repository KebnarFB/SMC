<?php
require_once "../../Backend/usuarios.php";
$user = new Usuarios();

$error_login = false;

if (isset($_POST['usuario']) && isset($_POST['pwd'])) {
    
    $usuario_ingresado = $_POST['usuario'];
    $contrasena_plana = $_POST['pwd'];

    $datos_usuarios = $user -> login($usuario_ingresado, $contrasena_plana);

    // Verificar si se encontró un usuario con ese nombre
    if ($datos_usuarios) {
        $_SESSION['id_cliente'] = $datos_usuarios['id_cliente'];
        $_SESSION['username'] = $datos_usuarios['username'];
        $_SESSION['loggedin'] = TRUE;
        
        header("Location: Principal.php");
        exit();
    } else {
        $error_login = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Asignamos un titulo para esta pagina-->
    <title>Inicio de sesion</title>
    <!-- Iconos para android -->
    <link rel="manifest" href="../public/manifest.json" />

    <!-- Icono para IOS -->
    <link rel="apple-touch-icon" href="../public/icons/ios.png">

    <!-- Icono para WEB -->
    <link rel="shortcut icon" type="image/png" href="../public/icons/desktop.png" />

    <!-- add to homescreen for ios -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="SMC" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <!--Ponemos estilos externos-->
    <link rel="stylesheet" href="../styles/Estilos.css">
</head>
<body>
    <main class="signup-container">
        <div class="signup-header">
            <h1>Inicio de sesion</h1>
        </div>

        <?php 
            if (isset($error_login) && $error_login) {
                echo "<p class='message-error'>Usuario o contraseña incorrectos</p>"; 
            }
        ?>

        <form id="form" class="form-content" method="post">
            <div class="input-group">
                <label for="usuario">Ingrese su usuario</label>
                <input 
                    class ="inputs" 
                    type="text" 
                    name="usuario" 
                    placeholder="Usuario">

                <label for="pwd">Contraseña</label>
                <input 
                    class ="inputs" 
                    type="password" 
                    name="pwd" 
                    placeholder="Contraseña">
            </div>

            <button class="botones crear" type="submit">Ingresar</button>

            <p class="login-link">
                No tienes cuenta?, 
                <a href="sing_up.php" class = "links">pulsa aqui para crear una</a>
            </p>
        </form>
    </main>
</body>
</html>
