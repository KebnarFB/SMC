let Boton = document.getElementById("form");
let ContentToast = document.getElementById("content-toast");


Boton.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(Boton);
    
    try {
        const response = await fetch('../../Backend/registro.php', {
            method: 'POST',
            body: formData
        });

        const Text = await response.text();
        const isFatalError = Text.includes('Fatal error') || Text.includes('Uncaught') || Text.includes('error:');
        
        if (response.ok && !isFatalError) {
            agregarToast({
                tipo: "Exito",
                titulo: "Registro Exitoso",
                descripcion: Text,
                autoClose: true
            });
        } else {
            agregarToast({
                tipo: "Error",
                titulo: "Error en el registro",
                descripcion: Text, 
                autoClose: false
            });
        }
    } catch (error) {
        console.error('Error:', error);
        agregarToast({
            tipo: "Error",
            titulo: "Error de Conexión",
            descripcion: "No se pudo conectar con el servidor o hubo un problema de red.",
            autoClose: false
        });
    }
})

const agregarToast = ({ tipo, titulo, descripcion, autoClose }) => {
    //Crear el nuevo toast
    const Toast = document.createElement("div");

    // agregar clases correspondientes
    Toast.classList.add("toast");

    if (tipo === "Exito" || tipo === "Error") {
        Toast.classList.add(tipo.toLowerCase());
    }

    if(autoClose){
        Toast.classList.add("auto_close");
        setTimeout(() => {
            closeToast(toastId);
            if(tipo === "Exito"){
                window.location.href = '../pages/login.php';
            } 
        }, 2000);
    }

    //agregar ID del toast
    const numAzar = Math.floor(Math.random() * 100);
    const fecha = Date.now();
    const toastId = fecha + numAzar;
    Toast.id = toastId;

    //Iconos
    const iconos = {
        Exito: '<img src="../Img/success.png" class="img-icon">',
        Error: '<img src="../Img/error.png" class="img-icon">'
    };

    //Plantilla
    const toast = `
    <div class="content-info">
        
        <div class="icono">
            ${iconos[tipo]}
        </div>
        
        <div class="texto">
            <p class="titulo">${titulo}</p>
            <p class="descripcion">${descripcion}</p>
        </div>
    </div>
    
    <button class="btn_close"> 
        <div class="icono">
            <img src="../Img/close.png" class="img-btn">
        </div>
    </button> `;

    //Agregar la plantilla al nuevo toast
    Toast.innerHTML = toast;

    //Agregar el nuevo toast al contenedor
    ContentToast.appendChild(Toast);

    //Funcion para manejar el cierre de la animacion
    const AnimacionCierre = (e) => {
        if(e.animationName === 'cierre'){
            Toast.removeEventListener("animationend", AnimacionCierre);
            Toast.remove();
        }
    }
    
    //Agregamos un Evento de escuhar para dectectar cuando termine la animacion
    Toast.addEventListener("animationend", AnimacionCierre);
}

//Evento para dectectar click en los toast
ContentToast.addEventListener("click", (e) => {
    const toastId = e.target.closest("div.toast")?.id;
    if (e.target.closest('button.btn_close')) {
        closeToast(toastId);
    }
});

//Funcion para cerrar el toast
const closeToast = (id) => {
    document.getElementById(id)?.classList.add("cerrando");
}
