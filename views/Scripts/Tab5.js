console.log("Tab5.js cargado");

// ELIMINAR EMPRESA 
document.addEventListener("click", function(e){
    if(e.target.classList.contains("btn-delete")){
        
        const id = e.target.dataset.id;

        if(!confirm("¿Eliminar esta empresa?")) return;

        fetch("/SMC/models/eliminar_empresa.php", {
            method:"POST",
            headers:{"Content-Type":"application/x-www-form-urlencoded"},
            body:"id=" + id
        })
        .then(r => r.text())
        .then(d => {
            if(d === "OK"){
                alert("Empresa eliminada.");
                location.reload();
            } else {
                alert("Error: " + d);
            }
        });
    }
});

// EDITAR EMPRESA
document.addEventListener("click", function(e){
    if(e.target.classList.contains("btn-edit")){

        const id = e.target.dataset.id;
        const nombre = prompt("Nuevo nombre de la empresa:");
        const comentarios = prompt("Actualizar comentarios:");

        if(!nombre) return alert("El nombre no puede estar vacío.");

        fetch("/SMC/models/actualizar_empresa.php", {
            method:"POST",
            headers:{"Content-Type":"application/x-www-form-urlencoded"},
            body:`id=${id}&nombre_empresa=${nombre}&comentarios=${comentarios}`
        })
        .then(r => r.text())
        .then(d => {
            if(d === "OK"){
                alert("Empresa actualizada.");
                location.reload();
            } else {
                alert("Error: " + d);
            }
        });
    }
});
