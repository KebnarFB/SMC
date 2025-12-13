<?php
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 'id_user';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$nombres = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : '';
$email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
$descripcion = isset($_SESSION['descripcion']) ? $_SESSION['descripcion'] : '';
$current_image = $_SESSION['img_perfil'];

//instancia para acceder a las empresas
$empresas = $controller->obtenerEmpresas();

//varaiable  para saber si es admin o usuario 
$rol_user = (isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1);

if ($rol_user) {
    $enlace_regreso = "index.php?page=dash";
} else {
    $enlace_regreso = "index.php?page=principal";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Perfil de usuario</title>
    <link rel = "icon" type = "image/png" href = "views/assets/img/logo.png" alt = "logo" />
    <!-- Estilos del modal -->
    <link rel="stylesheet" href="views/Styles/profile.css">
    <link rel="stylesheet" href="views/Styles/modalProfile.css">
</head>

<body class = "Design_P">
<!--Aqui va todo el apartado del heaeder-->
    <header class = "header">
        <a class = "buttons" id = "go_back" href="<?=$enlace_regreso;?>" >Regresar</a>
        <div class = "item" id = "title">
            <?php 
                // Obtener el nombre de usuario de la sesión
                $username = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : 'Nombre';
                echo "<h1>$username</h1>";
            ?>
        </div>
    </header>

    <!--Aqui va todo lo que ira en el lado izquierdo-->
    <aside class = "left_section">
        <pre>Configura tu perfil</pre>
        <form action="index.php?page=user&action=click_UpdateProfile(<?php echo $id_user;?>)" method="POST" enctype="multipart/form-data" id="profileForm">
            <input 
            type="file" 
            name="profile_image" 
            id="profile_image_input" 
            accept="image/*" 
            style="display: none;" >

            <div class="profile_section">
                <div class="container_image">
                    <div class="user_image" id="upload_area" onclick="activateFileInput()">
                        <?php 
                            
                        ?>
                        <img id="preview-img" src="<?php echo $current_image; ?> " alt="Imagen de perfil">
                        <p id="placeholder_text">Haz clic aquí para subir una imagen</p>
                    </div>
                </div>
            </div>
            <!--En esta parte se declara el form donde el usuario agrega sus datos-->
            <div class = "form_section">
                <label for="name_user">Nombre de usuario: </label>
                <input type = "text" id="name_user" name="username" value=<?php echo $username?> >

                <label for="name">Nombres</label>
                <input type = "text" id="name" name="nombres" value=<?php echo $nombres?>>

                <label for="user_email">Correo:</label>
                <input type = "email" id = "user_email" name="correo" value=<?php echo $email?>>

                <!-- Inputs ocultos -->
                <input type="hidden"  id="hidden_descripcion" name="descripcion">
                <input type="hidden" id="hidden_idEmpresa" name="id_empresa" required>
                <input type="hidden" name="action" value="update_profile">

                <button class="buttons" id="guardar" type="button" onClick="submitCombinedForms(event)">Guardar Cambios</button>  
                <button class = "buttons" id="close" onClick="abrirModal(event)">Eliminar cuenta</button>        
            </div>
        </form>
    </aside>

    <!--Aqui va todo lo que ira en el lado derecho-->
    <aside class = "right_section">
        <pre>Acerca de tu empresa:</pre>
        <form id="descriptionForm">
            <div class="description">

                <label for="empresa">Empresa a la perteneces*</label>
                <select name="id_empresa" id="empresa" required>
                    <option value="">-- Empresas --</option>
                    <?php foreach($empresas as $empresa):
                        $id_empresa = htmlspecialchars($empresa['id_empresa']); 
                        $nombre_empresa = htmlspecialchars($empresa['nombre_empresa']); ?>

                        <option value="<?=$id_empresa?>"> <?=$nombre_empresa?> </option>";
                    <?php endforeach; ?>
                </select>

                <label for="description_field">Agrega una descripción:</label>
                <textarea id="description_field" rows="4"> <?php echo $descripcion?> </textarea>
            </div>
        </form>
    </aside>

    <!-- modal -->
    <div id="modal" class="modal" style="display: none;">
        <div class="modal-content">
            <form id="formEliminar" method="POST" action="index.php?page=user&action=click_DeleteAccount($id_user)">
                <p>La cuenta se eliminará para SIEMPRE</p>
                <div class="modal-actions">
                    <button type="submit" id="btnConfirmar" class="btn btn-confirmar" disabled>
                        Confirmar (<span id="countdown">5</span>s)
                    </button>
                    
                    <button type="button" class="btn btn-cancelar" onclick="cerrarModal()">
                        Cancelar
                    </button>
                </div>
                <input type="hidden" name="delete_account" value="1">
            </form>
        </div>
    </div>

    <script src="views/Scripts/modal.js"></script>
    <script src="views/Scripts/profile.js"></script>
</body>

</html>