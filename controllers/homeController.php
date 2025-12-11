<?php
class HomeController {
    private $conexion; 

    public function __construct(Conexion $conexion){ 
        $this->conexion = $conexion;
    }

    public function index(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE){
            if($_SESSION['idRol'] == 1){
                header("Location: index.php?page=dash");
                exit();
            }else if($_SESSION['idRol'] == 2){
                header("Location: index.php?page=principal");
                exit();
            }
        }else{
            require_once __DIR__ . '/../views/pages/Homepage.html';
        }
    }
}
?>
