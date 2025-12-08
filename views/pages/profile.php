<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Perfil de usuario</title>
    <link rel = "icon" type = "image/png" href = "/SMC/views/assets/img/logo.png" alt = "logo" />
    <link rel = "stylesheet" href = "/SMC/views/Styles/profile.css">
    <!-- Estilos del modal -->
    <link rel="stylesheet" href="/SMC/views/Styles/modal.css">
</head>

<body class = "Design_P">
<!--Aqui va todo el apartado del heaeder-->
    <header class = "header">
        <button class = "buttons" id = "go_back"><a href="index.php?page=principal">Regresar</a></button>
        <div class = "item" id = "title">
            <?php 
                // Obtener el nombre de usuario de la sesión
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario';
                echo "<h1>Configura tu perfil $username</h1>";
            ?>
        </div>
    </header>

    <!--Aqui va todo lo que ira en el lado izquierdo-->
    <aside class = "left_section">
        <pre>Configura tu perfil</pre>
        <?php 
            // Obtener el ID del usuario de la sesión
            $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
        ?>
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
                            $current_image = $_SESSION['img_perfil']; 
                        ?>
                        <img id="preview-img" src="<?php echo $current_image; ?> " alt="Imagen de perfil">
                        <p id="placeholder_text">Haz clic aquí para subir una imagen</p>
                    </div>
                </div>
            </div>
            <!--En esta parte se declara el form donde el usuario agrega sus datos-->
            <div class = "form_section">
                <label>Nombre de usuario: </label>
                <input type = "text" id = "name_user" name = "username">

                <label>Nombres</label>
                <input type = "text" id="name_user" name="nombres">

                <label>Correo:</label>
                <input type = "email" id = "user_email" name="correo">

                <input type="hidden"  id="hidden_descripcion" name="descripcion">

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
                <label for="descripcion">Agrega una descripción:</label>
                <textarea id="description_field" rows="4"></textarea>
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
                        Confirmar (<span id="countdown">3</span>s)
                    </button>
                    
                    <button type="button" class="btn btn-cancelar" onclick="cerrarModal()">
                        Cancelar
                    </button>
                </div>
                <input type="hidden" name="delete_account" value="1">
            </form>
        </div>
    </div>

    <script src="/SMC/views/scripts/modal.js"></script>
    <script src="/SMC/views/scripts/profile.js"></script>
</body>

</html>