<?php 
require_once __DIR__ . "/../models/clientes.php";

class ClientController{
    private $clientModel;

    public function __construct(\Conexion $conexion){
        $this->clientModel = new Clientes();
    }

    public function index(){  
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if(isset($_POST['id_empresa'])){
                $this->click_Registrar();
            }
        }
    }

    public function click_Registrar(){
        $id_empresa = $_POST["id_empresa"];
        $cliente = $_POST["nombre_cliente"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $dirrecion = $_POST["direccion"];

        $registro = $this->clientModel->crearCliente($id_empresa, $cliente, $telefono, $correo, $dirrecion);

        if ($registro) {
            if($_SESSION['idRol'] == 1){
                header("Location: index.php?page=dash");
                echo"<script> 
                        alert('Cliente Agregado exitosamente');
                        window.location.href = 'index.php?page=dash';
                    </script>";
                exit();
            }else if($_SESSION['idRol'] == 2){
                echo"<script> 
                        alert('Cliente Agregado exitosamente');
                        window.location.href = 'index.php?page=principal';
                    </script>";
                exit();
            }
        }
    }

    public function getClientes(){
        $get = $this->clientModel->consultarClientes();
        return $get;
    }

    // Método para obtener clientes ordenados por likes (delegado al modelo)
    public function getClientsByLikes() {
        return $this->clientModel->getClientsByLikes();
    }
}
?>
