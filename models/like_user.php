<?php
require_once "connection.php";
session_start();

if(!isset($_SESSION['id_user'])){
    echo "NO_LOGIN";
    exit;
}

$id_user = $_SESSION['id_user'];      // el que da el like
$id_liked = $_POST['id_liked'];       // el que recibe el like

$conexion = new Conexion();
$pdo = $conexion->pdo;

// Verificar si ya dio like
$sql = "SELECT * FROM likes_usuarios WHERE id_user = ? AND id_liked = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_user, $id_liked]);

if($stmt->rowCount() > 0){
    echo "EXISTS";
    exit;
}

// Insertar like
$sql = "INSERT INTO likes_usuarios (id_liked, id_user) VALUES (?,?)";
$stmt = $pdo->prepare($sql);

if($stmt->execute([$id_liked, $id_user])){
    echo "OK";
} else {
    echo "ERROR_DB";
}
?>
