<?php 
require_once '../../../controllers/empresaController.php';
//instancias
$controller = new empresaController(new Conexion());
//utilizamos sus metodos mediante variables
$empresas = $controller->consultarEmpresas();
?>

<div class="admin-panel-container">
    <h2>Panel de Administración - Gestión de Empresas</h2>
    
    <div class="admin-card form-card">
        <h3>Agregar Nueva Empresa</h3>
        <form action="index.php?page=empresa" method="POST">
            <div class="form-group">
                <label for="nombre_empresa">Nombre de la Empresa</label>
                <input 
                    type="text" 
                    id="nombre_empresa" 
                    name="nombre_empresa" 
                    placeholder="Ej. Soluciones Innovauras" 
                    required>

                <label for="comentarios">Comentarios/Notas Adicionales</label>
                <textarea 
                    id="comentarios" 
                    name="comentarios" 
                    rows="3" 
                    placeholder="Información clave sobre la empresa"></textarea>
            </div>

            <?php
                // Mostrar mensajes de éxito o error
                if (isset($message)) {
                    echo "<div class='message'>{$message}</div>";
                }
            ?>
            <button type="submit" class="btn btn-success">Registrar Empresa</button>
        </form>
    </div>
    <div class="spacer"></div>
</div>