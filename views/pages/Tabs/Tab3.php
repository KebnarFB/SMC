<?php
require_once '../../../controllers/userController.php';
$usr = new userController(new Conexion());
$recommend = $usr->getRecommend();
?>

<div class="card-container">
    <div class="ClientsView" id="clients_list">
        <?php foreach($recommend as $r): ?>
            <div class="ProfileSugges">
                
                <div class="left_card_section">
                    <div class="profile_image">
                        <img src="/SMC/views/assets/uploads/profile.png" style="width:100%; border-radius:20px;">
                        <?php 
                            $profile_src = isset($_SESSION['img_perfil']) ? $_SESSION['img_perfil'] : '/SMC/views/assets/uploads/profile.png';
                        ?>
                        <img src="<?php echo $profile_src; ?>" alt="Perfil de usuario" style="width:100%; border-radius:20px;"/>
                    </div>
                </div>

                <div class="right_card_section">
                    <div class="sections">
                        <h3>Nombre del usuario</h3>
                        <p class="content_F"> <?= htmlspecialchars($r['nombres']) ?> </p>

                        <h3>Correo</h3>
                        <p class="content_F"><?= htmlspecialchars($r['correo']) ?></p>

                        <h3>Descripcion</h3>
                        <p class="content_F"><?= htmlspecialchars($r['descripcion']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!--  
<script>
// Filtramos los  clientes
document.getElementById("search_content").addEventListener("input", function() {
    let filter = this.value.toLowerCase();
    document.querySelectorAll(".ProfileSugges").forEach(card => {
        let text = card.innerText.toLowerCase();
        card.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

-->