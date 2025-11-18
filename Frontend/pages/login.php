<?php
include "../../Backend/conexion.php";

$error_login = false;

if (isset($_POST['usuario']) && isset($_POST['pwd'])) {
    
    $usuario_ingresado = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasena_plana = $_POST['pwd'];

    $sql = "SELECT id_cliente, username, contrasena FROM usuarios WHERE username = '$usuario_ingresado'";

    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontró un usuario con ese nombre
    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $hash_almacenado = $fila['contrasena'];

        if (password_verify($contrasena_plana, $hash_almacenado)) {
        
            $_SESSION['id_cliente'] = $fila['id_cliente'];
            $_SESSION['username'] = $fila['username'];
            $_SESSION['loggedin'] = TRUE;
            
            header("Location: Principal.php");
            exit();
        } else {
            $error_login = true;
        }
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
    <!--Agregamos un logo a la pagina-->
    <link rel="icon" type="image/x-icon" href="../Img/Logo.png">
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
                <a href="sing_up.html" class = "links">pulsa aqui para crear una</a>
            </p>
        </form>
    </main>
</body>
</html>
