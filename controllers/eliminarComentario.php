<?php
session_start();
require_once __DIR__ . '/../models/connection.php';

// Solo Admin puede eliminar
if (!isset($_SESSION['idRol']) || $_SESSION['idRol'] != 1) {
    echo "NO_ADMIN";
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id) {
    echo "ERROR";
    exit;
}

$pdo = (new Conexion())->pdo;

$sql = "DELETE FROM comentarios WHERE id_comentario = ?";
$stmt = $pdo->prepare($sql);
$ok = $stmt->execute([$id]);

echo $ok ? "OK" : "ERROR_DB";
