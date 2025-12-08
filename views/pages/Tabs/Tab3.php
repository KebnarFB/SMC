<?php
require_once __DIR__ . '/../../../models/Usuarios.php';

$usr = new Usuarios();
$clientes = $usr->obtenerRecomendaciones();
?>

<div class="card-container">
    <div class="titleAndButton">
    </div>


    <div class="ClientsView" id="clients_list">
        <?php foreach($clientes as $c): ?>
            <div class="ProfileSugges">
                
                <div class="left_card_section">
                    <div class="profile_image">
                        <img src="/SMC/views/uploads/profile.png" style="width:100%; border-radius:20px;">
                    </div>
                </div>

                <div class="right_card_section">
                    <div class="sections">
                        <h3>Nombre del cliente</h3>
                        <p class="content_F"><?= htmlspecialchars($c['nombres']) ?></p>
                    </div>

                    <div class="sections">
                        <h3>Correo</h3>
                        <p class="content_F"><?= htmlspecialchars($c['correo']) ?></p>
                    </div>


                    <div class="sections">
                        <h3>Dirección</h3>
                        <p class="content_F"><?= htmlspecialchars($c['descripcion']) ?></p>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

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
