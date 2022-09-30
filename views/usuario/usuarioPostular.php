<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empleado'])){
        header("Location: ../../index.php");
    }

    $post = new PostulacionDosController();
    $postulacion = $post->validarUnaPostulacion();

?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulación Empleo</title>
</head>
<body>
    <!-----Validar que no halla ningún registro en la tabla postulacion con los datos
    del empleado-------->
    <?php if($postulacion->num_rows == 0): ?>
        <div class="container-postulacion">
            <div class="details">
                <!-----Condición que verifica que el usuario tenga cargada su hoja de vida-------->
                <?php if($_SESSION['empleado']->hoja_vida != "sin_hoja_vida"): ?>

                <h1>Postulación</h1>
                <!-----formulario que guarda la postulación-------->
                <form action="../../execute.php?controller=postulacion&action=guardarPostulacion" method="post">
                    <!-----campos necesario para guardar la postulación-------->
                    <label for="">Usuario</label>
                    <input type="text" name="usuario" value="<?=$_SESSION['empleado']->id?>">
                    <label for="">Empleo</label>
                    <input type="text" name="empleo" value="<?=$_POST['codigo']?>">
                    
                    <input type="submit" value="Postularme">

                </form>
                <!-----En caso de no haber cargado la hoja de vida-------->
                <?php else: ?>
                    <h2>Debes cargar tu hoja de vida para postularte a un empleo</h2>
                <?php endif; ?>
            </div>
        </div>
        <!-----en caso de ya haberse postulado a este empleo-------->
    <?php else: ?>
        <h2>Ups! Parece que ya te has postulado a este empleo</h2>
    <?php endif; ?>

</body>
</html>