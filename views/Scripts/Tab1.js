// File: /views/Scripts/Tab1.js
console.log("Tab1.js cargado.");

if (!window.tab1LikeHandlerAdded) {
    document.addEventListener("click", tab1LikeHandler);
    window.tab1LikeHandlerAdded = true;
    console.log("Tab1 -> listener like agregado");
} else {
    console.log("Tab1 -> listener like ya estaba agregado");
}

function tab1LikeHandler(e) {
    // si el botón tiene clase .btn-like (puede ser el botón del perfil)
    if (e.target.classList && e.target.classList.contains("btn-like")) {
        e.preventDefault();

        const btn = e.target;
        const id = btn.getAttribute("data-id");
        if (!id) return;

        // evitar clicks recurrentes hasta respuesta
        if (btn.dataset.busy === "1") return;
        btn.dataset.busy = "1";

        fetch("/models/like_user.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "id_liked=" + encodeURIComponent(id)
        })
        .then(r => r.text())
        .then(res => {
            console.log("LIKE RESPONSE:", res);

            if (res === "OK") {
                // marcar visualmente (opcionales estilos)
                btn.classList.add("liked");
                btn.textContent = "Liked";

                // actualizar contador (span[data-like-count="ID"])
                let counter = document.querySelector('span[data-like-count="' + id + '"]');
                if (!counter) {
                    // si no existe, crear uno junto al botón
                    counter = document.createElement("span");
                    counter.dataset.likeCount = id;
                    counter.style.marginLeft = "8px";
                    counter.textContent = "1";
                    btn.insertAdjacentElement("afterend", counter);
                } else {
                    // incrementar contador (asegurarse número)
                    let value = parseInt(counter.textContent) || 0;
                    counter.textContent = value + 1;
                }

            } else if (res === "EXISTS") {
                alert("Ya diste like a este perfil.");
            } else if (res === "NO_LOGIN") {
                alert("Debes iniciar sesión para dar like.");
            } else {
                alert("Error al registrar like: " + res);
            }
        })
        .catch(err => {
            console.error("Error fetch like:", err);
            alert("Error de conexión.");
        })
        .finally(() => {
            btn.dataset.busy = "0";
        });
    }
}