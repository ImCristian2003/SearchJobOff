<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    if(!isset($_SESSION['empresa'])){
        header('Location: ../../index.php');
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    <style>

        img{
            height: auto;
            width: 300px;
        }

    </style>
</head>
<body>
    
    <div class="container-datos">
        <div class="details">
            <h1>Tus Datos Personales</h1>
            <?php   if(isset($_SESSION['modificado']) && $_SESSION['modificado'] == 'Complete'): ?>
                        
                        <strong>Modificación exitosa</strong>
                
            <?php   elseif(isset($_SESSION['modificado_fail']) && $_SESSION['modificado_fail'] == 'Fail'):  ?>

                        <strong>Modificación fallida</strong>

            <?php   endif; ?>
            <form action="../../execute.php?controller=empresa&action=guardarEmpresa&modificar=1" method="post" enctype="multipart/form-data">

                <label for="id">Identificación</label>
                <input type="text" name="nit" value="<?=$_SESSION['empresa']->id?>" id="id">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'id') : ""; ?>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?=$_SESSION['empresa']->nombre?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" value="<?=$_SESSION['empresa']->telefono?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="<?=$_SESSION['empresa']->direccion?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo</label>
                <input type="text" name="correo" value="<?=$_SESSION['empresa']->correo?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="imagen">Imagen</label>
                <input type="file" name="imagen">
                <?php if(!is_null($_SESSION['empresa']->imagen)): ?>
                    <img src="../../uploads/usuarios_perfil/<?=$_SESSION['empresa']->imagen?>" alt="perfil_usuario">
                <?php else: ?>
                    <img src="../../uploads/usuarios_perfil/usuario.png" alt="perfil_usuario">
                <?php endif; ?>

                <input type="submit" value="Actualizar Datos">

            </form>
            <form action="cambiarContrasena.php" method="post">
                <input type="hidden" value="<?=$_SESSION['empresa']->id?>">
                <input type="submit" value="Cambiar Contraseña">
            </form>

            <?php borrarSesion('modificado'); borrarSesion('modificado_fail'); borrarSesion('errores'); ?>

        </div>
    </div>
    
    <script>

        alert("Si modificas tus datos la sesión se cerrará de forma automatica");
        document.getElementById("id").style.display = "block";

    </script>
</body>
</html>