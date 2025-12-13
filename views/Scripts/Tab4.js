console.log("Tab4.js cargado correctamente.");

// PREVENIR MULTIPLES LISTENERS
if (!window.tab4ListenerAdded) {

    document.addEventListener("click", publicarComentarioHandler);
    window.tab4ListenerAdded = true;

    console.log("Tab4.js → Listener agregado correctamente");
} else {
    console.log("Tab4.js → Listener ya existía, NO se duplicó");
}


// FUNCIÓN PRINCIPAL DE EVENTOS
function publicarComentarioHandler(e) {

    // ================================
    //       PUBLICAR COMENTARIO
    // ================================
    if (e.target.id === "btnPublicarComentario") {

        console.log("Click detectado en Publicar Comentario");

        const txt = document.getElementById("nuevoComentario").value.trim();

        if (txt.length === 0) {
            alert("Escribe un comentario.");
            return;
        }

        fetch("controllers/agregarComentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "comentario=" + encodeURIComponent(txt)
        })
        .then(r => r.text())
        .then(res => {

            console.log("RESPUESTA DEL SERVIDOR:", res);

            if (res === "OK") {

                alert("Comentario agregado.");

                // Recarga SOLO el TAB4
                document.querySelector('.options[data-tab*="Tab4.php"]').click();

                document.getElementById("nuevoComentario").value = "";
            } else {
                alert("Error: " + res);
            }
        });
    }


    // ================================
    //       ABRIR MODAL EDITAR
    // ================================
    if (e.target.classList.contains("btn-edit-comment")) {

        document.getElementById("editId").value = e.target.dataset.id;
        document.getElementById("editText").value = e.target.dataset.text;

        document.getElementById("editModal").style.display = "flex";
    }

    // CERRAR MODAL
    if (e.target.id === "closeEdit") {
        document.getElementById("editModal").style.display = "none";
    }


    // ================================
    //         GUARDAR EDICIÓN
    // ================================
    if (e.target.id === "saveEdit") {

        const id = document.getElementById("editId").value;
        const comentario = document.getElementById("editText").value;

        fetch("controllers/actualizarComentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + id + "&comentario=" + encodeURIComponent(comentario)
        })
        .then(r => r.text())
        .then(res => {

            if (res === "OK") {
                alert("Comentario editado.");
                document.querySelector('.options[data-tab*=\"Tab4.php\"]').click();
            } else {
                alert("Error: " + res);
            }
        });
    }


    // ================================
    //         ELIMINAR COMENTARIO
    // ================================
    if (e.target.classList.contains("btn-delete-comment")) {

        if (!confirm("¿Eliminar este comentario?")) return;

        const id = e.target.dataset.id;

        fetch("controllers/eliminarComentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + id
        })
        .then(r => r.text())
        .then(res => {

            if (res === "OK") {
                alert("Comentario eliminado.");
                e.target.closest("tr").remove();
            } else {
                alert("Error: " + res);
            }
        });
    }
}
