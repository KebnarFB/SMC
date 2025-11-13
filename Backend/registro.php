<?php
include "conexion.php";

$nombre = $_POST['nombres'];
$usuario = $_POST['username'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombres, username, correo, contrasena) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    http_response_code(500); 
    echo "Error interno del servidor: " . $conn->error;
    $conn->close();
    exit;
}

$stmt->bind_param("ssss", $nombre, $usuario, $correo, $contrasena);

if ($stmt->execute()) {
    // Éxito
    http_response_code(200); 
    echo "Tu cuenta ha sido creada.";
} else {
    // Error
    http_response_code(400); 
    echo  $stmt->error;
}

$stmt->close();
$conn->close();
?>