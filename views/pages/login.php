<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Asignamos un titulo para esta pagina-->
    <title>Inicio de sesion</title>
    <!-- Icono para WEB -->
    <link rel="icon" type="image/png" href="views/assets/img/logo.png" />
    <!--Ponemos estilos externos-->
    <link rel="stylesheet" href="views/Styles/Estilos.css">
</head>
<body>
    <a href="index.php?page=home" class="return">Regresar</a>
    <main class="signup-container">
        <div class="signup-header ">
            <h1>Inicio de sesion</h1>
        </div>

        <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p class="message-error">Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>';
            }
        ?>

        <form id="form" class="form-content" method="POST" action="index.php?page=user&action=click_Login">
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
                <a href="index.php?page=register" class = "links">pulsa aqui para crear una</a>
            </p>
        </form>
    </main>
</body>
</html>