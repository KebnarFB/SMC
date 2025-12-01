<?php
require_once "../../../Backend/conexion.php";

$q = $_GET["q"] ?? "";
$buscar = "%".$q."%";

$sql = $conn->prepare("SELECT nombre_cliente FROM clientes WHERE nombre_cliente LIKE ?");
if (!$sql) {
    die("Error en prepare: " . $conexion->error);
}

$sql->bind_param("s", $buscar);

$sql->execute();
$res = $sql->get_result();

$salida = "";
while ($c = $res->fetch_assoc()) {
    $salida .= "<div>".$c['nombre_cliente']."</div>";
}

echo $salida;
