<?php
require_once "models/connection.php";
$conexion = new Conexion();

if($conexion -> connect){
    header("Location: views/pages/Homepage.html");
    exit;
}else{
    echo "No se pudo conectar al base de datos";
}
?>