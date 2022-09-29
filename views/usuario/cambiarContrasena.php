<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    if(!isset($_SESSION['empleado'])){
        header('Location: ../../index.php');
    } 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
    
    <div class="container-cambiar">
        <div class="details">

            <h2>Cambia tu contraseña</h2>
            <?php   if(isset($_SESSION['error']) && $_SESSION['error'] == 'Error'): ?>
                        
                        <strong>Error al querer modificar la contraseña, verifica bien los datos</strong>

            <?php   endif; ?>
            <form action="../../execute.php?controller=usuario&action=cambiarContrasena" method="post">

                <input type="hidden" name="empleado" value="<?=isset($_SESSION['empleado']) ? $_SESSION['empleado']->id : ""; ?>">
                <input type="hidden" name="empresa" value="<?=isset($_SESSION['empresa']) ? $_SESSION['empresa']->id : ""; ?>" >

                <label for="actual">Contraseña Actual</label>
                <input type="text" name="actual">

                <label for="nueva">Contraseña Nueva</label>
                <input type="text" name="nueva">

                <input type="submit" value="Cambiar">

            </form>
            <?php borrarSesion('error');  ?>

        </div>
    </div>
    <script>

        alert("Si modificas tu contraseña tendrás que volver a Iniciar Sesión");

    </script>
</body>
</html>