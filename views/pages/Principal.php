<?php 
if (!isset($_SESSION['id_user'])) {
  header("Location: index.php?page=home");
  exit;
} 

$profile_src = isset($_SESSION['img_perfil']) ? $_SESSION['img_perfil'] : 'views/assets/img/profile.png';
$name = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : 'Nombre';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SMC</title>

  <!-- LOGO -->
  <link rel="icon" type="image/png" href="/views/assets/img/logo.png" />

  <!-- CSS PRINCIPAL -->
  <link rel="stylesheet" href="/views/Styles/Principal.css" />

  <!-- CSS TABS -->
  <link rel="stylesheet" href="/views/Styles/Tabs/Tab1.css">
  <link rel="stylesheet" href="/views/Styles/Tabs/Tab2.css">
  <link rel="stylesheet" href="/views/Styles/Tabs/Tab3.css">
  <link rel="stylesheet" href="/views/Styles/Tabs/Tab4.css">
</head>

<body class="Design">

  <!-- HEADER -->
  <header class="header">
    <h1>SMC</h1>

    <div class="user-profile">
      <span class='user'>Hola, <?php echo $name;?></span>;

      <div class="profile">
        <ul>
          <li class="has-submenu">
            <img src="<?php echo $profile_src; ?>" alt="Perfil" class="profile-icon"/>

            <ul class="submenu">
              <li><a href="index.php?page=profile">Perfil</a></li>
              <li><a href="index.php?page=logout">Cerrar Sesión</a></li>
            </ul>

          </li>
        </ul>
      </div>
    </div>
  </header>

  <!-- MENU -->
  <nav class="menu">
    <div class="main-container">

      <!-- Tab1 -->
      <a href="#home" class="options" id="home" data-tab="views/pages/Tabs/Tab1.php">
        <img src="/views/assets/tabs/Menu.png" class="menu-icon" />
        <span class="menu-text">Inicio</span>
      </a>

      <!-- Tab2 -->
      <a href="#clients" class="options" id="clients"data-tab="views/pages/Tabs/Tab2.php">
        <img src="/views/assets/tabs/Clients.png" class="menu-icon" />
        <span class="menu-text">Clientes</span>
      </a>

      <!-- Tab3 -->
      <a href="#recommend" class="options" id="recommend" data-tab="views/pages/Tabs/Tab3.php">
        <img src="/views/assets/tabs/Recommends.png" class="menu-icon" />
        <span class="menu-text">Recomendaciones</span>
      </a>

      <!-- Tab4 -->
      <a href="#comments" class="options" id="comments" data-tab="views/pages/Tabs/Tab4.php">
        <img src="/views/assets/tabs/Comments.png" class="menu-icon" />
        <span class="menu-text">Comentarios</span>
      </a>

    </div>
  </nav>

  <!-- ÁREA PRINCIPAL -->
  <article class="main" id="main-content-area"></article>

  <!-- SCRIPTS -->
  <script src="views/scripts/Principal.js" defer></script>
  <script src="views/scripts/modal_Tab2.js" defer></script>
  <script src="views/scripts/Tab1.js" defer></script>
  <script src="views/scripts/Tab2.js" defer></script>
  <script src="views/scripts/Tab4.js" defer></script>
  <script src="views/scripts/Tab5.js" defer></script>
</body>
</html>
