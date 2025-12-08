<?php 
require_once __DIR__ . "/../models/connection.php";

class registerController {
    private $conexion; 

    public function __construct(Conexion $conexion){ 
        $this->conexion = $conexion;
    }

    public function index(){
        require_once __DIR__ . '/../views/pages/sing_up.html';
    }
}
?>