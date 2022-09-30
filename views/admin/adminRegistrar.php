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
    <title>Registrar Admin</title>
    <style>
        *{ /* Quitar márgenes y bordes por defecto.*/ 
            box-sizing:border-box;
            padding:0;
            margin:0;
        }

        html{ /* Codigo para que 1rem=10px*/  
            font-size:62.5%;
            font-family:'Roboto', sans-serif;
        }
        
        .obligatorio{
            color:red;
        }
        .container-empleado{
            background-image:url(../../assets/img/wave.png);
            background-repeat:no-repeat;
            background-size:cover;
            height:100vh;
            width:100%;
            position:relative;

            display:flex;
            justify-content:center;
            align-items:start;
            text-align:center;
        }
        .details{
            padding: 50px;
            width: 40%;
        }
        .details h1{
            color:#fff;
            margin:2rem;
            font-size:6rem;
            position:absolute;
            right:3rem;
            top:3rem;
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
            margin:5px 0;
            padding:5px 8px;
        }
        form input[type='password']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:5px 0;
            padding:5px 8px;
        }
        form input[type='submit']{
            border:none;
            border-radius:8px;
            background-color:#B8B8B8;
            color:#fff;
            cursor:pointer;
            font-weight:bold;
            font-size:1.6rem;
            height:3.2rem;
            margin: 5rem 15rem;
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


    
    </style>
</head>
<body>
    
    <div class="container-empleado">
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

                <input type="submit" value="Registrar">

            </form>
            <!-----Función para borrar las sesiones existentes-------->
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>
        </div>
    </div>

</body>
</html>