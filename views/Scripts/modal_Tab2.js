function abrirModal(event) {
    const modal = document.getElementById('modal');
    try {
        if (event) {
            event.preventDefault();
        }

        if (modal) {
            modal.style.display = 'block';
        } else {
            console.error("ERROR: No se pudo abrir el modal. El elemento 'modal' no se encontró en el DOM.");
        }
    } catch (error) {
        console.error("Error al ejecutar abrirModal:", error);
    }

}

function cerrarModal() {
    const modal = document.getElementById('modal');
    try {
        if (modal) {
            modal.style.display = 'none';
            console.log("modal cerrado");
        } else {
            console.error("ERROR: No se pudo cerrar el modal.");
        }
    } catch (error) {
        console.error("Error al ejecutar abrirModal:", error);
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target == modal) {
        cerrarModal();
    }
}