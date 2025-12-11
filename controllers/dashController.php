<?php
class DashController {
    private $conexion; 
    private $userModel;

    public function __construct(Conexion $conexion){ 
        $this->conexion = $conexion;
    }

    public function index(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== TRUE){
            header("Location: index.php?page=home");
            exit();
        }else{
            require_once __DIR__ . '/../views/pages/dashboard.php';
        }
    }
}
?>
