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
    <link rel="stylesheet" href="css/normalize.css">
    <title>Calificación - SearchJob</title>
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

        .container-calificacion{
            width: 100%;

            display:flex;
            align-items:center;
            justify-content:center;
        }

        .container-calificacion .details{
            margin: 1.5rem auto;
            width: 90%;
        }

        .container-calificacion .details header{
            background: var(--primario);
            border-radius: 5px;

            display:flex;
            align-items:center;
            justify-content:space-around;
        }

        .container-calificacion .details header a{
            background: var(--blanco);
            border-radius: 5px;
            color: #000;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 2rem;
            padding: 1rem 1.8rem;
            text-decoration: none;
        }

        .container-calificacion .details .comentarios h1{
            margin: 2.5rem 0.5rem;
            text-align: center;
        }

        .container-calificacion .details .comentarios .comentario {
            border: 1px solid #000;
            border-radius: 1rem;
            padding: 1.5rem;
        }

        .container-calificacion .details .comentarios .comentario p {
            font-size: 1.4rem;
        }

        .container-calificacion .details .comentarios .comentario .star{
            font-size: 2rem;
            color: yellow;
        }

        .eliminar {
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

    </style>
</head>
<body>
    <!-----Contenedor principal-------->
    <div class="container-calificacion">
        <div class="details">
            <header>
                <!------En caso de que esté logeado el empleado------->
                <?php if(isset($_SESSION['empleado'])): ?>
                    <a href="../usuario/indexUsuario.php">Volver</a>
                    <a href="../usuario/usuarioCalificaciones.php">Mis Calificaciones</a>
                    <a href="../usuario/usuarioComentario.php">Hacer un comentario</a>
                <!-------En caso de que esté logeada una empresa------>
                <?php elseif(isset($_SESSION['empresa'])): ?>
                    <a href="../empresa/indexEmpresa.php">Volver</a>
                    <a href="../empresa/empresaCalificaciones.php">Mis Calificaciones</a>
                    <a href="../empresa/empresaComentario.php">Hacer un comentario</a>
                <?php elseif(isset($_SESSION['admin'])): ?>
                    <a href="../admin/indexAdmin.php">Volver</a>
                <?php else: ?>
                    <a href="../../index.php">Volver</a>
                <?php endif; ?>
            </header>
            <div class="comentarios">
                <h1>Todas las calificaciones de nuestro sitio</h1>
                <!-----Condición para validar que halla por lo menos un registro-------->
                <?php if($cal->num_rows > 0 ): ?>
                    <!-----ciclo que imprime todos los datos correspondientes-------->
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
                            <span><b> Fecha Publicación:  </b>
                            <!-----Dar formato a la fecha-------->
                                <?php
                                    $date = date_create($calif->fecha);
                                    echo date_format($date,"Y/m/d H:i:s");
                                ?>
                            </span>
                            <?php if(isset($_SESSION['admin'])):?>
                                <a href="../../execute.php?controller=calificacionExecute&action=eliminarComentario&codigo=<?=$calif->codigo?>" class="eliminar">Eliminar Comentario</a>
                            <?php endif; ?>
                        </div>
                        <hr style="margin: 2rem 1rem;">
                    <?php endwhile; ?>
                <?php else: ?>
                    <h2>Aún no hay comentarios disponibles</h2>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>
</html>