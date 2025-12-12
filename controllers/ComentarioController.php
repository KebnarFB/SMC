<?php

class ComentarioController {

    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->pdo;
    }

    public function index() {

        $action = $_GET['action'] ?? 'list';

        switch ($action) {

            // LISTAR
            case 'list':
                $this->listar();
            break;

            // AGREGAR
            case 'add':
                $this->agregar();
            break;

            // ELIMINAR
            case 'delete':
                $this->eliminar();
            break;

            // EDITAR
            case 'edit':
                $this->editar();
            break;

            // GUARDAR EDICIÓN
            case 'update':
                $this->update();
            break;

            default:
                echo "Acción no válida.";
        }
    }

    private function listar() {
        $stmt = $this->db->query("SELECT * FROM comentarios ORDER BY id_comentario DESC");
        $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "views/pages/Tabs/Tab4.php";
    }

    private function agregar() {
        if (!empty($_POST['usuario']) && !empty($_POST['comentario'])) {
            $stmt = $this->db->prepare("INSERT INTO comentarios (id_usuario, comentario, fecha) VALUES (?, ?, NOW())");
            $stmt->execute([$_POST['usuario'], $_POST['comentario']]);
        }

        header("Location: index.php?page=comentario&action=list");
        exit;
    }

    private function eliminar() {
        if (!empty($_GET['id'])) {
            $stmt = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario=?");
            $stmt->execute([$_GET['id']]);
        }

        header("Location: index.php?page=comentario&action=list");
        exit;
    }

    private function editar() {
        if (empty($_GET['id'])) exit("ID no válido");

        $stmt = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario=?");
        $stmt->execute([$_GET['id']]);
        $comentario = $stmt->fetch(PDO::FETCH_ASSOC);

        include "views/pages/Tabs/EditarComentario.php";
    }

    private function update() {
        if (!empty($_POST['id']) && !empty($_POST['comentario'])) {

            $stmt = $this->db->prepare("UPDATE comentarios SET comentario=? WHERE id_comentario=?");
            $stmt->execute([$_POST['comentario'], $_POST['id']]);
        }

        header("Location: index.php?page=comentario&action=list");
        exit;
    }
}
