<?php
if (!isset($_SESSION['id_user'])) {
  header("Location: index.php?page=home");
  exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMC</title>
    <!--Agregamos un logo a la pagina-->
    <link rel="icon" type="image/png" href="/SMC/views/assets/img/logo.png" alt="logo" />
    <!-- Ponemos estilos externos -->
    <link rel="stylesheet" href="/SMC/views/Styles/Principal.css" />
    <!-- Estilos de los tabs -->
    <link rel="stylesheet" href="/SMC/views/Styles/Tabs/Tab1.css">
    <link rel="stylesheet" href="/SMC/views/Styles/Tabs/Tab2.css">
    <link rel="stylesheet" href="/SMC/views/Styles/Tabs/Tab3.css">
    <link rel="stylesheet" href="/SMC/views/Styles/Tabs/Tab4.css">
  </head>

  <body class="Design">
    <!--Creamos el encabezado-->
    <header class="header">
      <h1>SMC</h1>

      <div class="user-profile">
        <?php 
          // Obtener el nombre de usuario de la sesión
          $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario';
          echo "<span class='user'>Hola, $username</span>";
        ?>
        
        <div class="profile">
          <ul>
            <li class="has-submenu">
              <?php 
                $profile_src = isset($_SESSION['img_perfil']) ? $_SESSION['img_perfil'] : '/SMC/views/assets/uploads/profile.png';
              ?>
              
              <img src="<?php echo $profile_src; ?>" alt="Perfil de usuario" class="profile-icon"/>
              <ul class="submenu">
                <li><a href="index.php?page=profile">Ajustes</a></li>
                <li><a href="index.php?page=logout">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
    </header>

    <!-- menu -->
    <nav class="menu">
      <div class="main-container">
        <!-- Tab1 -->
        <a href="#home" class="options" id="home" data-tab="/SMC/views/pages/Tabs/Tab1.html">
          <img src="/SMC/views/assets/tabs/Menu.png" class="menu-icon" />
          <span class="menu-text">Inicio</span>
        </a>
        <!-- Tab2 -->
        <a href="#clients" class="options" id="clients" data-tab="/SMC/views/pages/Tabs/Tab2.php">
          <img src="/SMC/views/assets/tabs/Clients.png" class="menu-icon" />
          <span class="menu-text">Clientes</span>
        </a>
        <!-- Tab3 -->
        <a href="#recommend" class="options" id="recommend" data-tab="/SMC/views/pages/Tabs/Tab3.php">
          <img src="/SMC/views/assets/tabs/Recommends.png" class="menu-icon"/>
          <span class="menu-text">Recomendaciones</span>
        </a>
        <!-- Tab4-->
        <a href="#comments" class="options" id="comments" data-tab="/SMC/views/pages/Tabs/Tab4.html">
          <img src="/SMC/views/assets/tabs/Comments.png" alt="Comentarios" class="menu-icon"/>
          <span class="menu-text">Comentarios</span>
        </a>
      </div>
    </nav>

    <!-- articulo -->
    <article class="main" id="main-content-area"></article>

    <!-- modal -->


    <!--Barra de el lado derecho-->
    <aside class="right_bar">Contactos</aside>

    <!--Barra de el lado izquierdo-->
    <aside class="left_bar">Sidebar izquierdo</aside>

    <!--  JavaScripts -->
    <script src="/SMC/views/scripts/Principal.js"></script>
    <script src="/SMC/views/scripts/Tab2.js"></script>

  </body>
</html>

