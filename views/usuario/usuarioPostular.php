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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilosbuscador.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <title>Postulación Empleo</title>
    <style>

        body{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }
        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        .postulado{
            height: 100vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .postulado h2{
            font-size: 2rem;
        }

        .postulado h2 span {
            margin: 1rem;
        }

        .postulado a {
            background: var(--primario);
            border-radius: 1rem;
            color: #fff;
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
            padding: 1rem 2rem;
            text-decoration: none;
        }

    </style>
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
        <div class="postulado">
            <div class="details">
                <h2><span class="icon-notification"></span>Ups! Parece que ya te has postulado a este empleo</h2>
                <hr>
                <br>
                <br>
                <a href="../usuario/empleosBuscar.php">Volver</a>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>