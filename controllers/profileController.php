<?php 
require_once __DIR__ . "/../models/connection.php";
require_once __DIR__ . "/empresaController.php";
class ProfileController {
    private $conexion; 

    public function __construct(Conexion $conexion){ 
        $this->conexion = $conexion;
    }

    public function index(){
        $controller = new empresaController(new Conexion());
        require_once __DIR__ . '/../views/pages/profile.php';
    }
}
?>