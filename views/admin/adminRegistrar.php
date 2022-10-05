<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    if(!isset($_SESSION['admin'])){
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
    <title>Registrar Admin</title>
    <style>

        body{ /* Quitar márgenes y bordes por defecto.*/ 
            box-sizing:border-box;
            padding:0;
            margin:0;
        }

        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        html{ /* Codigo para que 1rem=10px*/  
            font-size:62.5%;
            font-family:'Roboto', sans-serif;
        }
        
        .obligatorio{
            color:red;
        }
        .container-empleado{
            background: var(--primario);
            height:auto;
            width:100%;
            position:relative;

            display:flex;
            justify-content:center;
            align-items:start;
            text-align:center;
        }
        .details{
            background: var(--blanco);
            border-radius: 1.5rem;
            height: auto;
            margin: 3rem;
            padding: 6rem;
            width: 50%;
        }
        .details h1{
            background: var(--primario);
            border-radius:3rem 0rem 3rem 3rem;
            color:#fff;
            margin:2rem;
            font-size:5rem;
            margin: 0;
            padding: 2.5rem;
            position:absolute;
            right:0rem;
            top:0rem;
        }
        .details form{ 
            font-size:2rem;
            width:100%;
            margin-top:8rem;
            padding:4rem;

            display:flex;
            flex-direction:column;
            justify-content:space-between;
            gap: 3px;
        }
        form input[type='text']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:1rem;
            padding:5px 8px;
        }
        form input[type='password']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:1rem;
            padding:5px 8px;
        }
        form input[type='submit']{
            border:none;
            border-radius:8px;
            background-color:var(--primario);
            color:#fff;
            cursor:pointer;
            font-weight:bold;
            font-size:2rem;
            margin: 5rem auto;
            padding: 1rem 3rem;
        }
        form input[type='email']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:5px 0;
            padding:5px 8px;
        }
        form input[type='file']{
            margin: .5rem;
        }
        form label{
            text-align:left;
            font-weight:700;
            font-size:1.8rem;
        }
        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            font-size: 2rem;
            padding: 1rem;
            position: absolute;
            left: 1.5rem;
            text-decoration: none;
            top: 1.5rem;
        }
    
    </style>
</head>
<body>
    
    <div class="container-empleado">
        <a href="indexAdmin.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
    
            <h1>Registro como Empleado</h1>
            <!-----Mostrar error en un campo en caso de que exista una sesión de fallo o exito-------->
            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Registro completado correctamente</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro fallido</strong>

            <?php   endif; ?>
            <!-----Formulario que guarda el registros de una empresa-------->
            <form action="../../execute.php?controller=adminExecute&action=guardarAdmin" method="post" enctype="multipart/form-data">

                <label for="id">Identificación <span class="obligatorio"> * </span></label>
                <input type="text" name="id" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'id') : ""; ?>
                
                <label for="nombre">Nombre <span class="obligatorio"> * </span></label>
                <input type="text" name="nombre" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellido') : ""; ?>

                <label for="telefono">Telefono <span class="obligatorio"> * </span></label>
                <input type="text" name="telefono" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Direccion <span class="obligatorio"> * </span></label>
                <input type="text" name="direccion" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo <span class="obligatorio"> * </span></label>
                <input type="email" name="correo" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="contrasena">Contraseña <span class="obligatorio"> * </span></label>
                <input type="password" name="contrasena" required>
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'contrasena') : ""; ?>

                <label for="perfil">Perfil <span class="obligatorio"> * </span> </label>
                <input type="text" name="perfil" required disabled value="3">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'perfil') : ""; ?>

                <input type="submit" value="Registrar Admin">

            </form>
            <!-----Función para borrar las sesiones existentes-------->
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>
        </div>
    </div>

</body>
</html>