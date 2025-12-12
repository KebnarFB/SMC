<?php
session_start();
require_once __DIR__ . '/../../../models/connection.php';

$conexion = new Conexion();
$pdo = $conexion->pdo;

/* OBTENER COMENTARIOS */
try {
    $sql = "SELECT 
                c.id_comentario,
                c.id_usuario,
                u.nombres AS autor_nombre,
                c.comentario,
                c.fecha
            FROM comentarios c
            LEFT JOIN usuarios u ON u.id_user = c.autor_id
            ORDER BY c.fecha DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $comentarios = [];
}

$isAdmin = !empty($_SESSION['idRol']) && $_SESSION['idRol'] == 1;
?>

<div class="admin-panel-container">
    <h2 id="titleHeader">Comentarios acerca de su negocio</h2>

    <!--PUBLICAR COMENTARIO-->
    <div class="admin-card" style="margin-bottom:25px;">
        <h3>Agregar comentario</h3>

        <textarea id="nuevoComentario"
                  placeholder="Escribe un comentario..."
                  rows="3"
                  style="width:100%; padding:10px; border-radius:6px; resize:none;"></textarea>

        <button id="btnPublicarComentario"
                style="margin-top:10px; padding:10px 16px; background:#00a86b; color:white;
                       border:none; border-radius:6px; cursor:pointer;">
            Publicar Comentario
        </button>
    </div>

    <!--TABLA DE COMENTARIOS-->
    <div class="admin-card">
        <h3>Comentarios Recientes</h3>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Usuario</th>
                    <th>Autor</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <?php if ($isAdmin): ?>
                    <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($comentarios)): ?>
                <?php foreach ($comentarios as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['id_comentario']) ?></td>
                        <td><?= htmlspecialchars($c['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($c['autor_nombre']) ?></td>
                        <td><?= htmlspecialchars($c['comentario']) ?></td>
                        <td><?= htmlspecialchars($c['fecha']) ?></td>

                        <?php if ($isAdmin): ?>
                        <td>
                            <button class="btn-edit-comment"
                                    data-id="<?= $c['id_comentario'] ?>"
                                    data-text="<?= htmlspecialchars($c['comentario']) ?>">
                                Editar
                            </button>

                            <button class="btn-delete-comment"
                                    data-id="<?= $c['id_comentario'] ?>">
                                Eliminar
                            </button>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="<?= $isAdmin ? 6 : 5 ?>">No hay comentarios.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!--MODAL EDITAR -->
<div id="editModal" style="
display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; width:350px;">
        <h3>Editar comentario</h3>

        <textarea id="editText" style="width:100%; height:100px;"></textarea>
        <br><br>

        <button id="saveEdit">Guardar</button>
        <button id="closeEdit">Cancelar</button>

        <input type="hidden" id="editId">
    </div>
</div>

<style>
.admin-panel-container { width:100%; padding:20px; }
.admin-panel-container h2 { text-align:center; font-size:32px; font-weight:bold; }
.admin-card { background:#fff; border-radius:10px; padding:25px; box-shadow:0 0 10px rgba(0,0,0,0.1); margin:0 auto; max-width:900px; }
.admin-card h3 { text-align:center; font-size:22px; margin-bottom:20px; }
.admin-table { width:100%; border-collapse:collapse; font-size:16px; }
.admin-table th { background:#00a86b; color:#fff; padding:10px; text-align:left; border-bottom:2px solid #007a52; }
.admin-table td { padding:10px; border-bottom:1px solid #e3e3e3; }
.admin-table tr:hover { background:#f5f5f5; }

.btn-edit-comment {
    background:#0275d8; border:none; padding:5px 12px; color:#fff;
    border-radius:5px; cursor:pointer; font-size:14px;
}
.btn-edit-comment:hover { background:#025aa5; }

.btn-delete-comment {
    background:#d9534f; border:none; padding:5px 12px; color:#fff;
    border-radius:5px; cursor:pointer; font-size:14px;
}
.btn-delete-comment:hover { background:#c9302c; }
</style>


<script>
// prevenir doble registro
document.removeEventListener("click", publicarComentarioHandler);
document.addEventListener("click", publicarComentarioHandler);

function publicarComentarioHandler(e){

    /*PUBLICAR COMENTARIO*/
    if(e.target.id === "btnPublicarComentario"){

        console.log("Click detectado en Publicar");

        const texto = document.getElementById("nuevoComentario").value.trim();

        if(texto.length === 0){
            alert("Escribe un comentario.");
            return;
        }

        fetch("/SMC/controllers/agregarComentario.php", {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: "comentario=" + encodeURIComponent(texto)
        })
        .then(r => r.text())
        .then(res => {

            console.log("RESPUESTA:", res);

            if(res === "OK"){
                alert("Comentario agregado");
                location.reload();
            } else {
                alert("Error: " + res);
            }
        });
    }

    /*ABRIR MODAL EDITAR */
    if(e.target.classList.contains("btn-edit-comment")){
        const id = e.target.dataset.id;
        const text = e.target.dataset.text;

        document.getElementById("editId").value = id;
        document.getElementById("editText").value = text;
        document.getElementById("editModal").style.display = "flex";
    }

    /* CERRAR MODAL*/
    if(e.target.id === "closeEdit"){
        document.getElementById("editModal").style.display = "none";
    }

    /* GUARDAR EDICIÓN*/
    if(e.target.id === "saveEdit"){

        const id = document.getElementById("editId").value;
        const comentario = document.getElementById("editText").value;

        fetch("/SMC/controllers/actualizarComentario.php", {
            method:"POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body:"id="+id+"&comentario="+encodeURIComponent(comentario)
        })
        .then(r=>r.text())
        .then(res=>{
            if(res === "OK"){
                location.reload();
            }
        });
    }

    /* ELIMINAR COMENTARIO */
    if(e.target.classList.contains("btn-delete-comment")){
        const id = e.target.dataset.id;

        fetch("/SMC/controllers/eliminarComentario.php", {
            method:"POST",
            headers:{ "Content-Type":"application/x-www-form-urlencoded" },
            body:"id="+id
        })
        .then(r=>r.text())
        .then(res=>{
            if(res === "OK"){
                e.target.closest("tr").remove();
            }
        });
    }
}
</script>
