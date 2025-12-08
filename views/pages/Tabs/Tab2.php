<?php
require_once "../../../models/usuarios.php";
$usuarios = new Usuarios();
$clientes = $usuarios->getClientes();
?>

<input type="search" id="search_content" class="search_bar" placeholder="Buscar cliente...">

<div class="ClientsView">

<?php foreach ($clientes as $cliente): ?>
    <div class="cliente_card"
         data-filter="<?= strtolower(
            iconv('UTF-8','ASCII//TRANSLIT', $cliente['nombre_cliente']) . ' ' .
            $cliente['telefono'] . ' ' .
            iconv('UTF-8','ASCII//TRANSLIT', $cliente['correo'])
         ) ?>"
         style="display:none;">  <!-- 🔥 IMPORTANTE: INICIA OCULTO -->

        <h3><?= $cliente['nombre_cliente'] ?></h3>
        <p><strong>Correo:</strong> <?= $cliente['correo'] ?></p>
        <p><strong>Teléfono:</strong> <?= $cliente['telefono'] ?></p>
        <p><strong>Empresa:</strong> <?= $cliente['id_empresa'] ?></p>
    </div>
<?php endforeach; ?>

</div>



<style>
.cliente_card {
    background: white;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.ClientsView {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.search_bar {
    width: 90%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #ccc;
}
</style>
