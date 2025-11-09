<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contraseña = $_POST['pwd'];

$sql = "INSERT INTO registro (nombre, usuario, email, pass) VALUES 
        ('$nombre', '$usuario', '$correo', '$contraseña')";

if($conn -> query($sql) === TRUE){
    http_response_code(200); // Éxito
}else{
    http_response_code(500); // Error
    echo "Error: " . $sql . "<br>" . $conn -> error;
}

$conn -> close();

?>