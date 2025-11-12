<?php 
include "../../Backend/conexion.php";

// Verificamos si se enviaron los datos del formulario
if(isset($_GET['usuario']) && isset($_GET['pwd'])) {
    $usuario = $_GET['usuario'];
    $contraseña = $_GET['pwd'];

    $sql = "SELECT * FROM registro WHERE usuario = '$usuario' AND pass = '$contraseña'";
    $resultado = mysqli_query($conn, $sql);

    if($resultado){
        while($fila = mysqli_fetch_assoc($resultado)){
            header("Location: Principal.html");
            exit(); 
        }
        echo "<p style='color: red; text-align: center;'>Usuario o contraseña incorrectos</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Asignamos un titulo para esta pagina-->
    <title>Inicio de sesion</title>

    <!--Agregamos un logo a la pagina-->
    <link rel="icon" type="image/x-icon" href="../Img/Logo.png">

    <!--Ponemos estilos externos-->
    <link rel="stylesheet" href="../styles/Estilos.css">
</head>
<body>
    <!--Creamos la seccion para el login-->
    <main>
        <!--Titulo-->
        <h1>Inicio de sesion</h1>
        <!--Creamos un contenedor-->
        <form class="contenido" method="get">
        <label>Ingrese su usuario</label>
        <input class ="inputs" type="text" name="usuario">

        <label>Contraseña</label>
        <input class ="inputs" type="password" name="pwd">

        <button class="botones" type="submit">Ingresar</button>
        <!--Creamos un parrafo para el caso de que no tenga cuenta-->
        <p>No tienes cuenta?, <a href="sing_up.html" class = "links">pulsa aqui para crear una</a></p>
        </form>
    </main>
</body>
</html>