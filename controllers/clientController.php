<?php 
require_once __DIR__ . "/../models/usuarios.php";

class userController{
    private $userModel;

    public function __construct(\Conexion $conexion){
        $this->userModel = new Usuarios;
    }

    public function index(){  
    }

    public function click_Registrar(){
    }

    public function click_consultar(){
    }
}
?>