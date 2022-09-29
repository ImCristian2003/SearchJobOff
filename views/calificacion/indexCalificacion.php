<?php 
    //Iniciar la sesión
    session_start();
    //Ficheros requeridos
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    //Instancia para el controlador de calificación
    $calificaciones = new CalificacionController();
    $cal = $calificaciones->conseguirCalificaciones();

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
    <title>Calificación - SearchJob</title>
    <style>

        .star{
            color: yellow;
        }

    </style>
</head>
<body>
    
    <div class="container-calificacion">
        <div class="details">
            <?php if(isset($_SESSION['empleado'])): ?>
                <a href="../usuario/indexUsuario.php">Volver</a>
                <a href="../usuario/usuarioCalificaciones.php">Mis Calificaciones</a>
                <a href="../usuario/usuarioComentario.php">Hacer un comentario</a>
            <?php elseif(isset($_SESSION['empresa'])): ?>
                <a href="../empresa/indexEmpresa.php">Volver</a>
                <a href="../empresa/empresaCalificaciones.php">Mis Calificaciones</a>
                <a href="../empresa/empresaComentario.php">Hacer un comentario</a>
            <?php else: ?>
                <a href="../../index.php">Volver</a>
            <?php endif; ?>
            <h1>Todos las calificaciones de nuestro sitio</h1>
            <?php if($cal->num_rows > 0 ): ?>
                <?php while($calif = $cal->fetch_object()): ?>
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
                    </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <h2>Aún no hay comentarios disponibles</h2>
                <?php endif; ?>

        </div>
    </div>

</body>
</html>