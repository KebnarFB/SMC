<?php 
require_once '../../../controllers/userController.php';
$controller = new userController(new Conexion());
session_start();
$usuarios = $controller->getUsers($_SESSION['id_user']);
?>

<!DOCTYPE html>
<html lang="en">
    <h2>Perfiles de usuario</h2>
    <div class="perfilContenedor">
        <?php foreach($usuarios as $usuario): 
            $nombre = htmlspecialchars($usuario['nombres']);
            $correo = htmlspecialchars($usuario['correo']);
            $img_perfil = htmlspecialchars($usuario['img_perfil']) ?: '/SMC/views/assets/uploads/profile.png';
            $descripcion = htmlspecialchars($usuario['descripcion']); ?>

            <div class="perfil">
                <img src="<?=$img_perfil?>" class="profile-image">
                <h3> <?=$nombre;?> </h3>
                <div class="perfil-text">
                    <p> <strong>Correo:</strong> <?=$correo;?> </p>
                    <p> <strong>Descripcion:</strong> <?=$descripcion;?> </p>
                </div>
                <button>like</button>
                <button>dislike</button>
                
            </div>
        <?php endforeach; ?>
    </div>
</html>
