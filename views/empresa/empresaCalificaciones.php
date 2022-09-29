<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empresa'])){
        header('Location: ../../index.php');
    } 

    $calificacion = new CalificacionController();
    $calificaciones = $calificacion->conseguirCalificacionesUsuario();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <title>Mis Calificaciones</title>
    <style>

        .star{
            color: yellow;
        }

    </style>
</head>
<body>
    
    <div class="container-usuario">
        <div class="details">
            <?php if($calificaciones->num_rows > 0 ): ?>
                <h1>Tus comentarios publicados</h1>
                <?php if(isset($_SESSION['borrado']) && $_SESSION['borrado'] == "Complete"): ?>
                    <b>Comentario borrado con éxito</b>
                <?php elseif(isset($_SESSION['borrado_fail']) && $_SESSION['borrado_fail'] == "Error"): ?>
                    <b>Error al tratar de borrar el comentario</b>
                <?php endif; ?>
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
                            <?php
                                $date = date_create($calif->fecha);
                                echo date_format($date,"Y/m/d H:i:s");
                            ?>
                        </span>
                        <a href="../../execute.php?controller=calificacionExecute&action=eliminarComentario&codigo=<?=$calif->codigo?>">Eliminar Comentario</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <h2>Aún no has hecho comentarios</h2>
            <?php endif; ?>
            <a href="../calificacion/indexCalificacion.php">Volver</a>
            <?php borrarSesion('borrado'); borrarSesion('borrado_fail'); ?>
        </div>
    </div>

</body>
</html>