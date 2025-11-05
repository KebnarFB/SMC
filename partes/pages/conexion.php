<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "smc_clientes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
