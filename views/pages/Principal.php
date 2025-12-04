<?php
require_once "../../models/usuarios.php";
$user = new Usuarios();

if (!isset($_SESSION['id_cliente'])) {
  header("Location: login.php");
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
    <link rel="icon" type="image/png" href="../public/icons/desktop.png" alt="logo" />
    <!-- Ponemos estilos externos -->
    <link rel="stylesheet" href="../Styles/Principal.css" />
    <!-- Estilos de los tabs -->
    <link rel="stylesheet" href="../Styles/Tabs/Tab1.css">
    <link rel="stylesheet" href="../Styles/Tabs/Tab2.css">
    <link rel="stylesheet" href="../Styles/Tabs/Tab3.css">
    <link rel="stylesheet" href="../Styles/Tabs/Tab4.css">
  </head>

  <body class="Design">
    <!--Creamos el encabezado-->
    <header class="header">
      <h1>SMC</h1>

      <button class="log-out">
        <a href="../../controllers/logout.php">Cerrar sesion</a>
      </button>
    </header>

    <!-- menu -->
    <nav class="menu">
      <div class="main-container">
        <!-- Tab1 -->
        <a href="#home" class="options" id="home" data-tab="Tabs/Tab1.html">
          <img src="../assets/tabs/Menu.png" class="menu-icon" />
          <span class="menu-text">Inicio</span>
        </a>
        <!-- Tab2 -->
        <a href="#clients" class="options" id="clients" data-tab="Tabs/Tab2.html">
          <img src="../assets/tabs/Clients.png" class="menu-icon" />
          <span class="menu-text">Clientes</span>
        </a>
        <!-- Tab3 -->
        <a href="#recommend" class="options" id="recommend" data-tab="Tabs/Tab3.html">
          <img src="../assets/tabs/Recommends.png"  class="menu-icon"/>
          <span class="menu-text">Recomendaciones</span>
        </a>
        <!-- Tab4-->
        <a href="#comments" class="options" id="comments" data-tab="Tabs/Tab4.html">
          <img src="../assets/tabs/Comments.png" alt="Comentarios" class="menu-icon"/>
          <span class="menu-text">Comentarios</span>
        </a>
      </div>
    </nav>

    <!-- articulo -->
    <article class="main" id="main-content-area"></article>

    <!--Barra de el lado derecho-->
    <aside class="right_bar">Contactos</aside>

    <!--Barra de el lado izquierdo-->
    <aside class="left_bar">Sidebar izquierdo</aside>

    <!--  JavaScripts -->
    <script src="../scripts/Principal.js"></script>
  </body>
</html>

