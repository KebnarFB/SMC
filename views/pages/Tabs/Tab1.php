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
            $img_perfil = $usuario['img_perfil'] ?: '/SMC/views/assets/uploads/profile.png';
            $descripcion = htmlspecialchars($usuario['descripcion'] ?? '');
            $total_likes = $usuario['total_likes'] ?? 0;
        ?>

        <div class="perfil">

            <img src="<?= $img_perfil ?>" class="profile-image">

            <h3><?= $nombre ?></h3>

            <div class="perfil-text">
                <p><strong>Correo:</strong> <?= $correo ?></p>
                <p><strong>Descripción:</strong> <?= $descripcion ?></p>
            </div>

            <!-- Botón Like -->
            <button class="btn-like" data-id="<?= $usuario['id_user'] ?>">👍</button>


        </div>

    <?php endforeach; ?>
</div>
