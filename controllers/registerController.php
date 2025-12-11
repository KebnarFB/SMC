<?php 
require_once __DIR__ . "/../models/connection.php";
require_once __DIR__ . "/userController.php";
class registerController {
    private $conexion; 

    public function __construct(Conexion $conexion){ 
        $this->conexion = $conexion;
    }

    public function index(){
        $controller = new userController($this->conexion);
        require_once __DIR__ . '/../views/pages/sing_up.php';
    }
}
?>
