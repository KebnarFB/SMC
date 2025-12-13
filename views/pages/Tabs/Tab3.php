<?php
require_once '../../../controllers/userController.php';

$usr = new userController(new Conexion());
$recommend = $usr->getUsersByLikes();
?>

<div class="card-container">
    <h2 style="text-align:center; margin-bottom:20px;">Usuarios Recomendados</h2>

    <div class="ClientsView" id="clients_list">

        <?php foreach($recommend as $u): ?>
            <div class="ProfileSugges">

                <div class="sections">

                    <h3>Nombre</h3>
                    <p><?= htmlspecialchars($u['nombres']) ?></p>

                    <h3>Correo</h3>
                    <p><?= htmlspecialchars($u['correo']) ?></p>

                    <h3>Descripción</h3>
                    <p><?= htmlspecialchars($u['descripcion']) ?></p>

                    <h3>Likes recibidos</h3>
                    <p><?= htmlspecialchars($u['total_likes']) ?></p>

                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>