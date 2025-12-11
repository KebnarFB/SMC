<?php 
require_once __DIR__ . "/../models/compras.php";

class compraController{
    private $compraModel;

    public function __construct(\Conexion $conexion){      
        $this->compraModel = new Compras($conexion);
    }

    public function index(){
    }


}
?>