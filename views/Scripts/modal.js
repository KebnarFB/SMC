const modal = document.getElementById('modal');
const btnConfirmar = document.getElementById('btnConfirmar');
const countdownSpan = document.getElementById('countdown');

let countdownInterval;
const initialTime = 3;

function abrirModal(event) {
    if (event) {
        event.preventDefault(); 
    }

    let timeLeft = initialTime;
    countdownSpan.textContent = timeLeft;
    btnConfirmar.disabled = true; // Deshabilita el botón al abrir
    btnConfirmar.innerHTML = `Confirmar (${timeLeft}s)`;

    modal.style.display = 'flex';
    
    countdownInterval = setInterval(() => {
        timeLeft--;
        countdownSpan.textContent = timeLeft;
        btnConfirmar.innerHTML = `Confirmar (${timeLeft}s)`;

        if (timeLeft <= 0) {
            clearInterval(countdownInterval); // Detener el temporizador
            btnConfirmar.disabled = false;    // HABILITAR el botón
            btnConfirmar.innerHTML = `Confirmar`; // Quitar el contador del texto
        }
    }, 1000); 
}

function cerrarModal() {
    modal.style.display = 'none';
    clearInterval(countdownInterval); 
}

window.onclick = function(event) {
    if (event.target == modal) {
        cerrarModal();
    }
}