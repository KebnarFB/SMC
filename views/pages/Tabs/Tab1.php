<?php 
require_once '../../../controllers/userController.php';
session_start();

$controller = new userController(new Conexion());
$usuarios = $controller->getUsers($_SESSION['id_user']);
?>

<h2>Perfiles de usuario</h2>

<div class="perfilContenedor">
    <?php foreach($usuarios as $usuario): ?>

        <?php
            $nombre = htmlspecialchars($usuario['nombres']);
            $correo = htmlspecialchars($usuario['correo']);
            $img_perfil = $usuario['img_perfil'] ?: 'views/assets/uploads/profile.png';
            $descripcion = htmlspecialchars($usuario['descripcion'] ?? '');
            $total_likes = $usuario['total_likes'] ?? 0;
        ?>

        <div class="perfil">

            <img src="<?= $img_perfil ?>" class="profile-image">

            <h3><?= $nombre ?></h3>

            <div class="perfil-text">
                <p><strong id="ClientsTexts">Correo: </strong> <?= $correo ?></p>
                <p><strong id="ClientsTexts">Descripcion: </strong> <?= $descripcion ?></p>
            </div>

            <!-- Botón Like -->
            <button class="btn-like" data-id="<?= $usuario['id_user'] ?>">
                <img src="/views/assets/img/like.png" alt="like" class="img-like">
            </button>


        </div>

    <?php endforeach; ?>
</div>
