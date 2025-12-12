<?php

class ComentarioModel {

    public static function getAll() {
        $db = Database::connect();
        $sql = $db->query("SELECT * FROM comentarios ORDER BY id DESC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM comentarios WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public static function add($data) {
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO comentarios (usuario, comentario, fecha) VALUES (?, ?, NOW())");
        $sql->execute([$data['usuario'], $data['comentario']]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $sql = $db->prepare("DELETE FROM comentarios WHERE id = ?");
        $sql->execute([$id]);
    }

    public static function update($data) {
        $db = Database::connect();
        $sql = $db->prepare("UPDATE comentarios SET comentario=? WHERE id=?");
        $sql->execute([$data['comentario'], $data['id']]);
    }
}
