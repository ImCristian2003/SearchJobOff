<?php 
    //Iniciar la sesión
    session_start();
    //Ficheros requeridos
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empleado'])){
        header('Location: ../../index.php');
    } 
    //Instancia para el controlador de calificación
    $notificaciones = new NotificacionController();
    $not = $notificaciones->conseguirNotificacionesUsuario();

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
            background: var(--blanco);
            border-radius: 5px;

            display:flex;
            align-items:flex-start;
            justify-content:flex-start;
        }

        .container-calificacion .details header a{
            background: var(--primario);
            border-radius: 5px;
            color: #fff;
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

        .container-calificacion .details .comentarios p.header{
            font-size: 1.2rem;
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

        .marcar {
            background: #16D21B;
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

        .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 1rem;
            text-align: center;
        }

        strong.bien {
            background: #16D21B;
            border-radius: 4px;
            color: #fff;
            display: block;
            letter-spacing: 1px;
            margin: 1rem;
            padding: 1rem;
            text-align: center;
        }

        strong.mal {
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            letter-spacing: 1px;
            margin: 1rem;
            padding: 1rem;
            text-align: center;
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
                    <a href="../usuario/indexUsuario.php"><span class="icon-undo2"></span></a>
                <!-------En caso de que esté logeada una empresa------>
                <?php elseif(isset($_SESSION['empresa'])): ?>
                    <a href="../empresa/indexEmpresa.php"><span class="icon-undo2"></span></a>
                <!-------En caso de que esté logeado un admin------>
                <?php elseif(isset($_SESSION['admin'])): ?>
                    <a href="../admin/indexAdmin.php"><span class="icon-undo2"></span></a>
                <?php else: ?>
                    <a href="../../index.php"><span class="icon-undo2"></span></a>
                <?php endif; ?>
            </header>
            <div class="comentarios">
                <h1>Panel de Notificaciones</h1>
                <!----Verificar si la sesión que existe indica un fallo o exito------------>
                <?php   if(isset($_SESSION['notificacion']) && $_SESSION['notificacion'] == 'Complete'): ?>
                        
                            <strong class="bien">Notificacion marcada de forma exitosa</strong>
                
                <?php   elseif(isset($_SESSION['notificacion_fail']) && $_SESSION['notificacion_fail'] == 'Fail'):  ?>

                            <strong class="mal">Intento de cambiar la notificacion fallido</strong>

                <?php   endif; ?>
                <p class="header">Bienvenido <b><?=$_SESSION['empleado']->nombre ?>,</b> 
                en esta sesión puedes visualizar todas las notificaciones que van dirigidas
                a tí.</p>
                <span class="aviso">
                    <span class="icon-notification"></span> 
                    Te recomendamos que al momento de leer una notificación, marques la misma 
                    como "leída", esto para tener un mayor control de las mismas y en caso de ser 
                    algo urgente, no recurrir al bloqueo o eliminación permanente de tu 
                    cuenta.
                </span>
                <hr style="margin: 2rem 1rem;">

                <!-----Condición para validar que halla por lo menos un registro-------->
                <?php if($not != false): ?>
                    <!-----ciclo que imprime todos los datos correspondientes-------->
                    <?php while($notificaciones = $not->fetch_object()): ?>
                        <div class="comentario">
                            <h2><?=$notificaciones->asunto; ?></h2>
                            <p><?=$notificaciones->cuerpo; ?></p>
                            <span><b> Fecha Publicación:  </b>
                            <!-----Dar formato a la fecha-------->
                                <?php
                                    $date = date_create($notificaciones->fecha);
                                    echo date_format($date,"Y/m/d H:i:s");
                                ?>
                            </span>
                            <?php if(isset($_SESSION['admin']) && $notificaciones->estado == "pendiente"):?>
                                <a href="../../execute.php?controller=notificacionExecute&action=marcarLeido&codigo=<?=$notificaciones->codigo?>" class="marcar"><span class="icon-pencil"></span> Marcar Como Leida</a>
                            <?php else:?>
                                <span class="marcar">
                                    <span class="icon-check"></span> 
                                    Mensaje leído
                                </span>
                            <?php endif; ?>
                        </div>
                        <hr style="margin: 2rem 1rem;">
                    <?php endwhile; ?>
                <?php else: ?>
                    <h2>Aún no tienes notificaciones</h2>
                <?php endif; ?>
            </div>
            <?php borrarSesion('notificacion'); borrarSesion('notificacion_fail'); ?>

        </div>
    </div>

</body>
</html>