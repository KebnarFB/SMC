<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear cuenta</title>
    <link rel="icon" type="image/png" href="/SMC/views/assets/img/logo.png" />

    <link rel="stylesheet" href="/SMC/views/styles/Toast.css" />
    <link rel="stylesheet" href="/SMC/views/styles/Estilos.css" />
  </head>

  <body>
    <div class="signup-container">
      <div class="signup-header">
        <h1>Creación de Cuenta</h1>
        <p>Regístrate para comenzar a utilizar la plataforma.</p>
      </div>

      <form id="form" class="form-content" method="POST" action="index.php?page=user&action=click_Registrar">
        <div class="input-group">
          <label for="nombres">Nombres</label>
          <input
            id="nombres"
            class="inputs"
            name="nombres"
            type="text"
            placeholder="Ej: Juan Antonio Pérez"
            required/>

          <label for="username">Nombre de usuario</label>
          <input
            id="username"
            class="inputs"
            name="username"
            type="text"
            placeholder="Máx 10 caracteres"
            required/>

          <label for="idRole">Selecciona tu rol</label>
          <select name="idRole" id="idRole" class="inputs" required>
            <option value="">--Rol--</option>
            <?php
              $roles = $controller->getRoles(); 
              foreach($roles as $rol): 
            ?>
              <option value="<?= $rol['id_Rol'] ?>">
                <?= $rol['name_rol'] ?>
              </option>
            <?php 
            endforeach; 
            ?>
          </select>

          <label for="correo">Correo Electrónico</label>
          <input
            id="correo"
            class="inputs"
            name="correo"
            type="email"
            placeholder="ejemplo@dominio.com"
            required/>

          <label for="pwd">Contraseña</label>
          <input
            id="clave"
            class="inputs"
            type="password"
            name="pwd"
            placeholder="Debe ser segura"
            required/>

          <label for="confirmar_clave">Confirmar Contraseña</label>
          <input
            id="confirmar_clave"
            class="inputs"
            type="password"
            name="pwd_confirm"
            placeholder="Confirmar"
            name="confirmar_pwd"
            required/>
        </div>

        <button class="botones crear" type="submit">Crear cuenta</button>

        <p class="login-link">
          ¿Ya tienes cuenta? <a href="index.php?page=login" class="links">Inicia sesión</a>
        </p>
      </form>
    </div>

    <div class="content-toast" id="content-toast"></div>
    <script src="/SMC/views/Scripts/Toast.js"></script>
  </body>
</html>
