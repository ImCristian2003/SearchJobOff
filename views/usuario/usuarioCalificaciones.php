<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empleado'])){
        header('Location: ../../index.php');
    } 

    $calificacion = new CalificacionController();
    $calificaciones = $calificacion->conseguirCalificacionesUsuario();

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
    <title>Mis Calificaciones</title>
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

        .container-usuario{
            width: 100%;

            display:flex;
            align-items:center;
            justify-content:center;
        }

        .container-usuario .details{
            margin: 1.5rem auto;
            width: 90%;
        }

        .container-usuario .details h1{
            margin: 2.5rem 0.5rem;
            text-align: center;
        }

        .container-usuario .details .comentario {
            border: 1px solid #000;
            border-radius: 1rem;
            padding: 1.5rem;
        }

        .container-usuario .details .comentario p {
            font-size: 1.4rem;
        }

        .container-usuario .details .comentario a {
            background: var(--primario);
            color: #fff;
            display: block;
            font-weight:bold;
            font-size:1.2rem;
            letter-spacing: 1px;
            margin: 1.5rem 1rem;
            padding: 1rem 1.5rem;
            text-align:center;
            text-decoration: none;
            width: 20%;
        }

        .container-usuario .details .comentario .star{
            font-size: 2rem;
            color: yellow;
        }

        .star{
            font-size: 2rem;
            color: yellow;
        }

        .volver{
            background: var(--primario);
            color: #fff;
            font-weight:bold;
            font-size:1.2rem;
            letter-spacing: 1px;
            margin: 1.5rem 1rem;
            padding: 1rem 2.5rem;
            text-decoration: none;
        }

    </style>
</head>
<body>
    
    <div class="container-usuario">
        <div class="details">
            <!-----Condición para validar que existan registros-------->
            <?php if($calificaciones->num_rows > 0 ): ?>
                    <h1>Tus comentarios publicados</h1>
                    <!-----Condición para validar la sesion que indica un fallo o exito------->
                    <?php if(isset($_SESSION['borrado']) && $_SESSION['borrado'] == "Complete"): ?>
                        <b>Comentario borrado con éxito</b>
                    <?php elseif(isset($_SESSION['borrado_fail']) && $_SESSION['borrado_fail'] == "Error"): ?>
                        <b>Error al tratar de borrar el comentario</b>
                    <?php endif; ?>
                    <!-----ciclo que muestra todos los datos-------->
                    <?php while($calif = $calificaciones->fetch_object()): ?>
                    <div class="comentario">
                        <h2>Usuario: <?=$calif->nombre_usuario; ?> <?=$calif->apellido; ?></h2>
                        <!----Validar la cantidad de estrellas que se verán en la vista-->
                        <?php if($calif->calificacion == 1): ?>
                            <span class="icon-star-full star"></span>
                        <?php elseif($calif->calificacion == 2): ?>
                            <span class="icon-star-full star"></span><span class="icon-star-full star"></span>
                        <?php elseif($calif->calificacion == 3): ?>
                            <span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span>
                        <?php elseif($calif->calificacion == 4): ?>
                            <span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span>
                        <?php else: ?>
                            <span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span><span class="icon-star-full star"></span>
                        <?php endif; ?>
                        <p><?=$calif->descripcion; ?></p>
                        <span>Fecha Publicación: 
                            <!-----Formato para la fecha-------->
                            <?php
                                $date = date_create($calif->fecha);
                                echo date_format($date,"Y/m/d H:i:s");
                            ?>
                        </span>
                        <!------Link que elimina un comentario------->
                        <a href="../../execute.php?controller=calificacionExecute&action=eliminarComentario&codigo=<?=$calif->codigo?>">Eliminar Comentario</a>
                    </div>
                    <hr style="margin: 2rem 1rem;">
                <?php endwhile; ?>
            <?php else: ?>
                <h2>Aún no has hecho comentarios</h2>
            <?php endif; ?>
            <a href="../calificacion/indexCalificacion.php" class="volver">Volver</a>
            <!-----Funciones para borrar las sesiones-------->
            <?php borrarSesion('borrado'); borrarSesion('borrado_fail'); ?>
        </div>
    </div>

</body>
</html>