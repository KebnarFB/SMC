<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "smc_clientes";

// Creamos una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

//Mostramos un mensaje para checar que se haya hecho la conexion
echo "Conexión exitosa";
?>