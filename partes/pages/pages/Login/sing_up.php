<?php
include('../conexion.php'); // conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_empresa = trim($_POST['nombre_empresa']);
    $nombre_cliente = trim($_POST['nombre_cliente']);
    $usuario = trim($_POST['usuario']);
    $correo = trim($_POST['correo']);
    $clave = trim($_POST['clave']);

    // Verificamos  si la empresa existe
    $stmt = $conn->prepare("SELECT id_empresa FROM Empresa WHERE nombre_empresa = ?");
    $stmt->bind_param("s", $nombre_empresa);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $id_empresa = $row['id_empresa'];
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO Empresa (nombre_empresa) VALUES (?)");
        $stmt_insert->bind_param("s", $nombre_empresa);
        $stmt_insert->execute();
        $id_empresa = $stmt_insert->insert_id;
        $stmt_insert->close();
    }
    $stmt->close();

    // Insertarmos el  cliente
    $stmt_cliente = $conn->prepare("INSERT INTO Cliente (id_empresa, nombre_cliente, correo, direccion)
    VALUES (?, ?, ?, ?)");
    $direccion = "Sin dirección"; 
    $stmt_cliente->bind_param("isss", $id_empresa, $nombre_cliente, $correo, $direccion);

    if ($stmt_cliente->execute()) {
        echo "<script>alerta('Cuenta creada correctamente'); window.location='login.html';</script>";
    } else {
        echo "<script>alerta('Error al crear la cuenta');</script>";
    }

    $stmt_cliente->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>

    <!-- Logo -->
    <link rel="icon" type="image/x-icon" href="logo.jpg">

    <!-- Estilos externos -->
    <link rel="stylesheet" href="Estilos.css">
</head>
<body>
    <main>
        <h1>Creación de cuenta</h1>

        <form method="POST" action="">
            <!-- Empresa -->
            <label>Nombre de la empresa</label>
            <input class="inputs" type="text" name="nombre_empresa" required>

            <!-- Nombre -->
            <label>Ingrese su nombre</label>
            <input class="inputs" type="text" name="nombre_cliente" required>

            <!-- Usuario -->
            <label>Ingrese un usuario</label>
            <input class="inputs" type="text" name="usuario" required>

            <!-- Correo -->
            <label>Ingrese un correo</label>
            <input class="inputs" type="email" name="correo" required>

            <!-- Contraseña -->
            <label>Contraseña</label>
            <input class="inputs" type="password" name="clave" required>

            <!-- Botón -->
            <button class="botones" type="submit">Crear cuenta</button>

            <!-- Enlace de inicio -->
            <p>¿Ya tienes cuenta? <a href="login.html" class="links">Inicia sesión</a></p>
        </form>
    </main>
</body>
</html>
