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

        .container-postulacion{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-postulacion .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;
        }

        .container-postulacion .details h2{
            text-align: center;
        }

        .container-postulacion .details label{
            width: 100%;
        }

        .container-postulacion .details form{
            font-size: 1.2rem;
            text-align: center;
        }

        .container-postulacion .details form input{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-postulacion .details form input[type="submit"]{
            background: var(--primario);
            border:none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
            display: block;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 1rem auto;
            margin-top: 2rem;
            padding: 0.4rem;
            width: 70%;
        }
        /*Aviso del span */
        .container-postulacion .details form .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 0.5rem;
        }

        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            padding: 1rem;
            position: absolute;
            left: 1rem;
            text-decoration: none;
            top: 1rem;
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
            <a href="empleosBuscar.php" class="icono-volver"><span class="icon-undo2"></span></a>
            <div class="details">
                <!-----Condición que verifica que el usuario tenga cargada su hoja de vida-------->
                <?php if($_SESSION['empleado']->hoja_vida != "sin_hoja_vida"): ?>

                <h2>Postulación</h2>
                <!-----formulario que guarda la postulación-------->
                <form action="../../execute.php?controller=postulacion&action=guardarPostulacion" method="post">
                    <!-----campos necesario para guardar la postulación-------->
                    <input type="hidden" name="usuario" value="<?=$_SESSION['empleado']->id?>">
                    <input type="hidden" name="empleo" value="<?=$_POST['codigo']?>">
                    <input type="hidden" name="empleo_nombre" value="<?=$_POST['empleo']?>">
                    <span>Estás por postularte al empleo <b><?=$_POST['empleo']?></b></span>
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