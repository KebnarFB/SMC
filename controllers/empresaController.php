<?php 
require_once __DIR__ . "/../models/empresa.php";

class empresaController{
    private $companyModel;

    public function __construct(\Conexion $conexion){      
        $this->companyModel = new Empresa($conexion);
    }

    public function index(){
        $message = null;
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']); // ELIMINAR el mensaje de la sesión
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            if(isset($_POST['nombre_empresa'])){
                $this->registrarEmpresa(); 
                return; 
            }
        }
        require_once 'views/pages/dashboard.php';
    }

    public function registrarEmpresa(){
        $name_empresa = $_POST['nombre_empresa'];
        $comentarios = $_POST['comentarios'];
        $registro = $this->companyModel->registrar($name_empresa, $comentarios);

        if ($registro) {
            // Éxito
            $_SESSION['message'] = "La empresa ha sido registrada exitosamente.";
        } else {
            // Error de base de datos
            $_SESSION['message'] = "No se pudo registrar la empresa. Intenta de nuevo.";
        }
        header("Location: index.php?page=dash");
        exit;
    }



   public function consultarEmpresas() {

    $empresas = [];

    if (!isset($this->conexion)) {
        return $empresas; // evita errores si no hay conexión
    }

    $sql = "SELECT id_empresa, nombre_empresa, comentarios FROM empresa";
    $result = $this->conexion->query($sql);

    if (!$result) {
        return $empresas; // evita errores si la consulta falla
    }

    while ($fila = $result->fetch_assoc()) {
        $fila['comentarios'] = $fila['comentarios'] ?? "";
        $empresas[] = $fila;
    }

    return $empresas;
}

public function getAllComments() {
    return $this->model->getComments();
}



}
?>