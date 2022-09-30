<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empresa'])){
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
    <link rel="stylesheet" href="css/normalize.css">
    <title>Publicar Comentario</title>
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

        .container-comentario{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display:flex;
            align-items:center;
            justify-content:center;
        }

        .container-comentario .details{
            background: var(--blanco);
            padding: 3rem;
            width: 50%;
        }

        .container-comentario .details h2{
            margin: 1rem 1rem;
            text-align: center;
        }

        .container-comentario .details form input, select, textarea{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.5rem;
            width:100%;
        }

        .container-comentario .details form textarea{
            height: 7rem;
        }

        .container-comentario .details form input[type="submit"]{
            background: var(--primario);
            border: none;
            color: #fff;
            cursor: pointer;
            font-weight:bold;
            font-size:1rem;
            letter-spacing: 1px;
            margin: 2rem auto;
            padding: 1rem 2.5rem;
            width:80%;
        }

    </style>
</head>
<body>
    
    <div class="container-comentario">
        <div class="details">
            
            <h2>Publica tu propio comentario</h2>
            <!-----Condición para validar si existe un error al insertar un comentario------->
            <?php   if(isset($_SESSION['error']) && $_SESSION['error'] == 'Error'): ?>
                        
                        <strong>Error al querer insertar el comentario</strong>

            <?php   endif; ?>
            <!-----formulario que guarda la calificacion-------->
            <form action="../../execute.php?controller=calificacionExecute&action=guardarCalificacion" method="post">

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" value="<?=$_SESSION['empresa']->id?>">
                <!-----Mostrar el error de un campo-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'usuario') : ""; ?>

                <label for="calificacion">Calificación</label>
                <select name="calificacion" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <!-----Mostrar un error en un campo-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'calificacion') : ""; ?>
                
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion"></textarea>
                <!-----Mostar un error en un campo-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'descripcion') : ""; ?>

                <input type="submit" value="Publicar">

            </form>}
            <!-----funciones para borrar las sesiones-------->
            <?php borrarSesion('error'); borrarSesion('errores'); ?>

        </div>
    </div>

</body>
</html>