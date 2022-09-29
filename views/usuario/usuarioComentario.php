<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <title>Publicar Comentario</title>
    <style>

        

    </style>
</head>
<body>
    
    <div class="container-comentario">
        <div class="details">
            
            <h2>Publica tu propio comentario</h2>
            <?php   if(isset($_SESSION['error']) && $_SESSION['error'] == 'Error'): ?>
                        
                        <strong>Error al querer insertar el comentario</strong>

            <?php   endif; ?>
            <form action="../../execute.php?controller=calificacionExecute&action=guardarCalificacion" method="post">

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" value="<?=$_SESSION['empleado']->id?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'usuario') : ""; ?>

                <label for="calificacion">Calificación</label>
                <select name="calificacion" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'calificacion') : ""; ?>
                
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion"></textarea>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'descripcion') : ""; ?>

                <input type="submit" value="Publicar">

            </form>
            <?php borrarSesion('error'); borrarSesion('errores'); ?>

        </div>
    </div>

</body>
</html>