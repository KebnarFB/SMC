<?php
session_start();
include "../../../Backend/conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>

<h2>Clientes</h2>

<input type="text" id="buscar" placeholder="Buscar..." onkeyup="buscarCliente(this.value)">
<div id="resultados"></div>

<script>
function buscarCliente(q) {
    if (q.length === 0) {
        document.getElementById("resultados").innerHTML = "";
        return;
    }

    fetch("./buscar_clientes.php?q=" + encodeURIComponent(q))
        .then(res => res.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html;
        });
}
</script>

</body>
</html>
