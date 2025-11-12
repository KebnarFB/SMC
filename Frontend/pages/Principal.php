<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMC</title>
    <!-- Carpeta base de las imagenes -->
    <base href="../Img/" />
    <base href="../Scripts/" />
    <!--Agregamos un logo a la pagina-->
    <link rel="icon" type="image/x-icon" href="Logo.png" alt="logo" />
    <!-- Ponemos estilos externos -->
    <link rel="stylesheet" href="../styles/Principal.css" />
  </head>

  <body class="Design">
    <!--Creamos el encabezado-->
    <header class="header">
      <div class="item" id="title">
        <h1>SMC</h1>
      </div>

      <button class="profileSection" id="profile">
        <div>Iniciar sesion</div>
      </button>
    </header>

    <!---Creamos el menu de seleccion-->
    <nav class="menu">
      <div class="main-container">
        <a href="#" class="options" id="home">
          <img src="../Img/Tabs/Menu.png" alt="Inicio" class="menu-icon" />
          <span class="menu-text">Inicio</span>
        </a>

        <a href="#" class="options" id="clients">
          <img src="../Img/Tabs/Clients.png" alt="Clientes" class="menu-icon" />
          <span class="menu-text">Clientes</span>
        </a>

        <a href="#" class="options" id="recommend">
          <img
            src="../Img/Tabs/Recommends.png"
            alt="Recomendaciones"
            class="menu-icon"
          />
          <span class="menu-text">Recomendaciones</span>
        </a>

        <a href="#" class="options" id="comments">
          <img
            src="../Img/Tabs/Comments.png"
            alt="Comentarios"
            class="menu-icon"
          />
          <span class="menu-text">Comentarios</span>
        </a>
      </div>
    </nav>

    <!--Barra de el lado derecho-->
    <aside class="right_bar">Contactos</aside>

    <!--Barra de el lado izquierdo-->
    <aside class="left_bar">Sidebar izquierdo</aside>

    <!--Lo principal-->
    <article class="main">
      <h2>Perfiles de usuario</h2>
      <div class="perfilContenedor">
        <!--Aqui pondremos los campos que nos serviran para insertar informacion-->
        <div class="perfil">
          <label>usuario 1</label>
        </div>
        <div class="perfil">
          <label>usuario 2</label>
        </div>
        <div class="perfil">
          <label>usuario 3</label>
        </div>
        <div class="perfil">
          <label class="user4">usuario 4</label>
        </div>
        <div class="perfil">
          <label>usuario 5</label>
        </div>
        <div class="perfil">
          <label> usuario 6</label>
        </div>
        <div class="perfil">
          <label> usuario 7</label>
        </div>
        <div class="perfil">
          <label> usuario 8</label>
        </div>
        <div class="perfil">
          <label> usuario 9</label>
        </div>
      </div>
    </article>
    <!--La parte de abajo-->
    <footer class="footer">
      <div id="MandV">
        <h2>Mision</h2>
        <h2>Vision</h2>
      </div>
    </footer>

    <script src="../scripts/Principal.js"></script>
  </body>
</html>
