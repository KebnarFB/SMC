<?php
session_start();
require_once "models/connection.php";
$conexion = new Conexion();

if (!$conexion->connect) {
    die("Error: No se pudo conectar a la base de datos"); 
}
$page = $_GET['page'] ?? 'home'; 
$controllerFile = "controllers/" . $page . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($page) . "Controller"; 
    
    if (class_exists($className)) {
        $controller = new $className($conexion);
        $controller->index();
    } else {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Error: Controlador no válido (Clase no encontrada).";
    }
    
} else {
    header("HTTP/1.0 404 Not Found");
    require_once "views/pages/NotFound.html";
}
?>

