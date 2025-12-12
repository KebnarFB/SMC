console.log("Tab2.js cargado correctamente.");


if (window._tab2Loaded) {
    console.log("Tab2.js -> Ya estaba cargado. Cancelado.");
} else {
    window._tab2Loaded = true;
}

/*Inicializar TAB2 cuando el contenido esté listo*/
function iniciarTab2() {
    console.log("TAB2 → Buscando elementos...");

    const input = document.getElementById("search_content");

    if (!input) {
        console.log("TAB2 → Input no listo, reintentando...");
        setTimeout(iniciarTab2, 300);
        return;
    }

    const cards = document.querySelectorAll(".cliente_card");
    const likeButtons = document.querySelectorAll(".btn-like");

    console.log(
        `TAB2 → Elementos encontrados → Cards: ${cards.length} | Likes: ${likeButtons.length}`
    );

    /* ACTIVAR BUSCADOR*/
    const normalizeText = (t) =>
        t.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

    input.addEventListener("input", () => {
        const text = normalizeText(input.value);

        cards.forEach((card) => {
            const filtro = normalizeText(card.dataset.filter);
            card.style.display = filtro.includes(text) ? "block" : "none";
        });
    });

        /*ACTIVAR BOTONES LIKE*/
    likeButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            console.log("LIKE detectado en cliente ID:", id);

            fetch("/SMC/models/likeCliente.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id_cliente=" + id,
            })
                .then((r) => r.text())
                .then((resp) => {
                    console.log("RESPUESTA LIKE:", resp);
                    alert(resp);
                });
        });
    });

    console.log("TAB2 → Completamente inicializado.");
}

setTimeout(iniciarTab2, 300);
