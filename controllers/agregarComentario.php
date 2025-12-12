<?php
session_start();
require_once __DIR__ . '/../models/connection.php';

if (!isset($_SESSION['id_user'])) {
    echo "NO_LOGIN";
    exit;
}

$comentario = trim($_POST['comentario'] ?? "");

if ($comentario === "") {
    echo "EMPTY";
    exit;
}

$pdo = (new Conexion())->pdo;

$sql = "INSERT INTO comentarios (id_usuario, autor_id, comentario, fecha)
        VALUES (?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

$ok = $stmt->execute([
    $_SESSION['id_user'],  // ID del usuario
    $_SESSION['id_user'],  // autor_id 
    $comentario
]);

echo $ok ? "OK" : "ERROR_DB";
