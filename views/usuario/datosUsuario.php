<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    if(!isset($_SESSION['empleado'])){
        header('Location: ../../index.php');
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Datos Personales</title>
    <style>

        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        body{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        .container-datos{
            background: var(--primario);
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-datos .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;
        }

        .container-datos .details h1{
            text-align: center;
        }

        .container-datos .details label{
            width: 100%;
        }

        .container-datos .details form input{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-datos .details form input[type="submit"]{
            background: var(--primario);
            border:none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
            display: block;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0 auto;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 70%;
        }
        /*Aviso del span */
        .container-datos .details form .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 0.5rem;
        }

        img{
            height: auto;
            width: 150px;
        }

        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            padding: 1rem;
            position: absolute;
            left: 1.5rem;
            text-decoration: none;
            top: 1.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container-datos">
        <a href="indexUsuario.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <h1>Tus Datos Personales</h1>
            <!-----Condiciónes para validar si existe una sesion de fallo o exito-------->
            <?php   if(isset($_SESSION['modificado']) && $_SESSION['modificado'] == 'Complete'): ?>
                        
                        <strong>Modificación exitosa</strong>
                
            <?php   elseif(isset($_SESSION['modificado_fail']) && $_SESSION['modificado_fail'] == 'Fail'):  ?>

                        <strong>Modificación fallida</strong>

            <?php   endif; ?>
            <form action="../../execute.php?controller=empleado&action=guardarEmpleado&modificar=1" method="post" enctype="multipart/form-data">

                <label for="id">Identificación</label>
                <input type="text" name="id" value="<?=$_SESSION['empleado']->id?>" id="id">
                <!-----Condición para validar que exista el error del campo id-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'id') : ""; ?>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?=$_SESSION['empleado']->nombre?>">
                <!-----Condición para validar que exista el error del campo nombre-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" value="<?=$_SESSION['empleado']->apellido?>">
                <!-----Condición para validar que exista el error del campo apellido-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellido') : ""; ?>

                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" value="<?=$_SESSION['empleado']->telefono?>">
                <!-----Condición para validar que exista el error del campo telefono-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="<?=$_SESSION['empleado']->direccion?>">
                <!-----Condición para validar que exista el error del campo direccion-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo</label>
                <input type="text" name="correo" value="<?=$_SESSION['empleado']->correo?>">
                <!-----Condición para validar que exista el error del campo correo-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="hoja_vida">Hoja de Vida</label>
                <input type="file" name="hoja_vida">
                <span class="aviso"><span class="icon-notification"></span> Recuerda que debes cargar tu hoja de vida para postularte a un empleo</span>

                <label for="imagen">Imagen de Perfíl</label>
                <input type="file" name="imagen">
                <!-----Condición para validar si el usuario tiene cargada una imagen de perfil o no-------->
                <?php if(is_null($_SESSION['empleado']->imagen) || empty($_SESSION['empleado']->imagen)): ?>   
                    <img src="../../uploads/usuarios_perfil/usuario.png" alt="perfil_usuario">
                <?php else: ?>
                    <img src="../../uploads/usuarios_perfil/<?=$_SESSION['empleado']->imagen?>" alt="perfil_usuario">
                <?php endif; ?>

                <input type="submit" value="Actualizar Datos">

            </form>
            <!-----formulario para cambiar la contraseña-------->
            <form action="cambiarContrasena.php" method="post">
                <input type="hidden" value="<?=$_SESSION['empleado']->id?>">
                <input type="submit" value="Cambiar Contraseña">
            </form>
            <!-----funciones para borrar las sesiones-------->
            <?php borrarSesion('modificado'); borrarSesion('modificado_fail'); borrarSesion('errores'); ?>

        </div>
    </div>
    
    <script>

        alert("Si modificas tus datos la sesión se cerrará de forma automatica");
        document.getElementById("id").style.display = "none";

    </script>
</body>
</html>