<?php 
require_once "../../Backend/usuarios.php";
$user = new Usuarios();

if (isset($_POST['username'])) { 
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
        //http_response_code(200);
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
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear cuenta</title>
    <link rel="icon" type="image/png" href="../public/icons/desktop.png" />

    <link rel="stylesheet" href="../styles/Toast.css" />
    <link rel="stylesheet" href="../styles/Estilos.css" />
  </head>

  <body>
    <div class="signup-container">
      <div class="signup-header">
        <h1>Creación de Cuenta</h1>
        <p>Regístrate para comenzar a utilizar la plataforma.</p>
      </div>

      <form id="form" class="form-content" method="post">
        <div class="input-group">
          <label for="nombres">Nombres</label>
          <input
            id="nombres"
            class="inputs"
            name="nombres"
            type="text"
            placeholder="Ej: Juan Antonio Pérez"
            required
          />

          <label for="username">Nombre de usuario</label>
          <input
            id="username"
            class="inputs"
            name="username"
            type="text"
            placeholder="Máx 10 caracteres"
            required
          />

          <label for="correo">Correo Electrónico</label>
          <input
            id="correo"
            class="inputs"
            name="correo"
            type="email"
            placeholder="ejemplo@dominio.com"
            required
          />

          <label for="pwd">Contraseña</label>
          <input
            id="clave"
            class="inputs"
            type="password"
            name="pwd"
            placeholder="Debe ser segura"
            required
          />

          <label for="confirmar_clave">Confirmar Contraseña</label>
          <input
            id="confirmar_clave"
            class="inputs"
            type="password"
            name="pwd_confirm"
            placeholder="Confirmar"
            name="confirmar_pwd"
            required
          />
        </div>

        <button class="botones crear" type="submit">Crear cuenta</button>

        <p class="login-link">
          ¿Ya tienes cuenta? <a href="login.php" class="links">Inicia sesión</a>
        </p>
      </form>
    </div>

    <div class="content-toast" id="content-toast"></div>
    <script src="../scripts/Toast.js"></script>
  </body>
</html>
