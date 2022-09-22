<?php session_start(); ?>
<?php require_once "../../helpers/utils.php"; ?>
<?php require_once "../../config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Empresa</title>
</head>
<body>
    
    <div class="container-form">
        <div class="details-form">

            <h1>Sistema de Registro Empresa</h1>

            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Registro completado correctamente</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro fallido</strong>

            <?php   endif; ?>

            <form action="../../execute.php?controller=empresa&action=guardarEmpresa" method="post">

                <label for="nit">Nit de la empresa</label>
                <input type="text" name="nit" placeholder="nit" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nit') : ""; ?>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="nombre" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" placeholder="telefono" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" placeholder="direccion" >
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo</label>
                <input type="text" name="correo" placeholder="correo" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" placeholder="contrasena" >
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'contrasena') : ""; ?>

                <label for="perfil">Perfil</label>
                <input type="text" name="perfil" placeholder="perfil" disabled value = "2" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'perfil') : ""; ?>

                <input type="submit" value="Registrarme Ahora">

            </form>
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>

        </div>
    </div>

</body>
</html>