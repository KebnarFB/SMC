console.log("Tab2.js cargado");

// Esperar a que el contenido del TAB2 esté insertado en el DOM
function activarBuscadorClientes() {
    console.log("TAB2 → Intentando activar buscador...");

    const input = document.getElementById("search_content");
    const cards = document.querySelectorAll(".cliente_card");

    if (!input || cards.length === 0) {
        console.log("TAB2 → Elementos aún no disponibles, reintentando...");
        setTimeout(activarBuscadorClientes, 300);
        return;
    }

    console.log("TAB2 → Buscador ACTIVADO con " + cards.length + " clientes");

    // Quitar acentos
    const normalizeText = (text) =>
        text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

    // Iniciar ocultando todo
    cards.forEach(card => card.style.display = "none");

    input.addEventListener("input", () => {
        const text = normalizeText(input.value);

        cards.forEach(card => {
            const filter = normalizeText(card.dataset.filter);

            if (text.length > 0 && filter.includes(text)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
}

setTimeout(activarBuscadorClientes, 300);
