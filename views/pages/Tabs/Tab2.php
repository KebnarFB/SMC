<?php
    require_once '../../../controllers/empresaController.php';
    require_once '../../../controllers/clientController.php';
    //instancias
    $controller = new empresaController(new Conexion());
    $controllerC = new ClientController(new Conexion());
    //utilizamos sus metodos mediante variables
    $empresas = $controller->consultarEmpresas();
    $clientes = $controllerC->getClientes();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Buscador y boton para agregar clientes -->
<div class="contenido">
    <div class="search-wrapper">
        <input type="search" id="search_content" class="search_bar" placeholder="Buscar cliente...">
    </div>

    <button onclick="abrirModal(event)" class="abrirModal">Agregar Cliente</button>
</div>

<!-- Modal para agregar al cliente -->
<div id="modal" class="modal" >
    <div class="modal-content">
        <!-- header del modal -->
        <div class="modal-header">
            <h3>Agregar Cliente</h3>
            <button onclick="cerrarModal()" class="cerrarModal">X</button>
        </div>
        <!-- Formulario para agregar el cliente -->
        <form class="modal-form" method="POST" action="index.php?page=client" >
            <label for="empresa">Empresa</label>
            <select name="id_empresa" id="empresa">
                <option value="">-- Sin Empresa Asignada --</option>
                <?php
                    foreach($empresas as $empresa){
                        $id_empresa = htmlspecialchars($empresa['id_empresa']); 
                        $nombre_empresa = htmlspecialchars($empresa['nombre_empresa']); 
                        echo "<option value='$id_empresa'>$nombre_empresa</option>";
                    }
                ?>
            </select>

            <label for="cliente">Nombre Cliente</label>
            <input type="text" class="modal-input" name="nombre_cliente" id="cliente">

            <label for="telefono">telefono</label>
            <input type="number" class="modal-input" name="telefono" id="telefono">

            <label for="correo">correo</label>
            <input type="email" class="modal-input" name="correo" id="correo">

            <label for="address">Direccion</label>
            <input type="text" class="modal-input" name="direccion" id="address">

            <button type="submit" class="modal-button">Guardar</button>
        </form>
    </div>
</div>

<div class="ClientsView">
    <?php if (is_array($clientes) || is_object($clientes)): 
        foreach($clientes as $cliente): ?>
        <div class="cliente_card" 
            data-filter="<?= strtolower(
                iconv('UTF-8', 'ASCII//TRANSLIT', 
                $cliente['nombre_cliente'] . '' . 
                $cliente['telefono'] . '' .
                $cliente['correo'])
            )?>" 
            style="display:none;">

            <h3> <?= $cliente['nombre_cliente']?> </h3>
            <p> <strong>Correo: </strong> <?= $cliente['correo']?> </p>
            <p> <strong>Telefono: </strong> <?= $cliente['telefono']?> </p>
            <p> <strong>Empresa: </strong> <?= $cliente['id_empresa']?> </p>
        </div>
    <?php endforeach; 
        endif;
    ?>
</div>
</html>


