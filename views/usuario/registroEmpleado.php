<?php session_start(); ?>
<?php require_once "../../helpers/utils.php"; ?>
<?php require_once "../../config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="container-empleado">
        <div class="details">
    
            <h1>Registrarse</h1>

            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Registro completado correctamente</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro fallido</strong>

            <?php   endif; ?>

            <form action="../../execute.php?controller=empleado&action=guardarEmpleado" method="post" enctype="multipart/form-data">

                <label for="id">Identificación</label>
                <input type="text" name="id" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'id') : ""; ?>
                
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellido') : ""; ?>

                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo</label>
                <input type="email" name="correo" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'contrasena') : ""; ?>

                <label for="perfil">Perfil</label>
                <input type="text" name="perfil" required disabled value="1">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'perfil') : ""; ?>

                <label for="hoja_vida">Hoja de Vida</label>
                <input type="file" name="hoja_vida">

                <input type="submit" value="Enviar">

            </form>
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>
        </div>
    </div>

</body>
</html>