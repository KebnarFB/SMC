<?php
session_start();
require_once __DIR__ . '/../models/connection.php';

// Solo admin puede actualizar 
if (!isset($_SESSION['idRol']) || $_SESSION['idRol'] != 1) {
    echo "NO_ADMIN";
    exit;
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$comentario = trim($_POST['comentario'] ?? '');

if ($id <= 0 || $comentario === '') {
    echo "ERROR";
    exit;
}

try {
    $pdo = (new Conexion())->pdo;

    $sql = "UPDATE comentarios SET comentario = ? WHERE id_comentario = ?";
    $stmt = $pdo->prepare($sql);
    $ok = $stmt->execute([$comentario, $id]);

    echo $ok ? "OK" : "ERROR_DB";
} catch (PDOException $e) {
   
    echo "ERROR_DB";
}
