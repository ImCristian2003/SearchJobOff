<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['admin'])){
        header('Location: ../../index.php');
    } 

    //instancia para saber la cantidad de usuario registrados
    $contar = new UsuarioDosController();
    $contado = $contar->contarUsuarios();

    //instancia para saber la cantidad de municipios registrados
    $contar1 = new MunicipioController();
    $contado1 = $contar1->contarMunicipios();

    //instancia para saber la cantidad de calificaciones registrados
    $contar2 = new CalificacionController();
    $contado2 = $contar2->contarCalificaciones();

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
    <title>Bienvenido</title>
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

        .container{
            width:100%;
        }

        .caja{
            display: flex;
            flex-direction: row;
        }

        .caja-izquierda{
            background-color: #69b7b9;
            height: 100vh;
            width: 30%;
        }
        .caja-izquierda .caja-izquierda-uno{
            height: 50%;
            padding: 10px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .caja-izquierda .caja-izquierda-uno h1{
            color: var(--blanco);
            font-family: var(--FuentePpal);
            font-size: 3.5rem;
            font-weight: bold;
            margin: 1rem 2rem;
        }
        .caja-izquierda .caja-izquierda-uno .imagen{
            border-radius:50%;
            width: 50%;
        }
        .caja-izquierda div.caja-izquierda-uno h2{
            color: var(--blanco);
            font-family:Verdana, Geneva, Tahoma, sans-serif ;
            margin: 1em 2em;
        }
        .caja .caja-izquierda .caja-izquierda-dos{
            height: 50%;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .caja .caja-izquierda .caja-izquierda-dos a {
            color: var(--blanco);
            text-decoration: none;
            font-size: 1.6rem;
        }
        .caja .caja-izquierda .caja-izquierda-dos .caja-izquierda-dos-a{
            display: flex;
            flex-direction: column;
            height: 50%;
            padding: 1rem;
        }
        .caja .caja-izquierda .caja-izquierda-dos .caja-izquierda-dos-a a{
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0.4rem;
        }
        .caja .caja-izquierda .caja-izquierda-dos .caja-izquierda-dos-aa {
            display: flex;
            flex-direction: column;
            align-items: center;

            margin-top:1rem;
            height: 50%;
        }
        .caja .caja-izquierda .caja-izquierda-dos .caja-izquierda-dos-aa a{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.7rem;
            margin-top:.3rem;
        }

        .caja .caja-derecha{
            height: 100vh;
            width: 70%;

            display: flex;
            justify-content: center;
            flex-direction:column;
            text-align: center;
            align-items: center;
        }

        .caja .caja-derecha .details{
            background: var(--primario);
            height: 10%;
            width: 100%;

            display: flex;
            justify-content: flex-end;
            text-align: center;
            align-items: center;
        }

        .caja .caja-derecha .details a {
            color: #fff;
            font-size: 1.3rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 1rem 2rem;
            text-decoration:none;
        }

        .caja .caja-derecha .details1{
            height: 90%;
            width: 100%;

            display: flex;
            justify-content: center;
            flex-direction:column;
            text-align: center;
            align-items: center;
        }

        .caja .caja-derecha .details1 h1{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 3rem;
        }
        .caja .caja-derecha .details1 p{
            font-size: 1.2rem;
            margin: 2rem;
        }

        .estadisticas{
            width: 100%;
            height: 100vh;
        }

        .estadisticas .cartas{
            height: 80%;
            width: 100%;

            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .estadisticas .cartas .details-cartas{
            box-shadow: 0.5rem 0.5rem 3px #A39790;

            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .estadisticas .cartas .details-cartas .details1{
            padding: 1rem 2rem;

            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: center;
        }

        .estadisticas .cartas .details-cartas .details1 span{
            color: #fff;
            font-size: 3.5rem;
            margin: 1rem;
        }

        .estadisticas .cartas .details-cartas .details1 h2{
            color: #DCC4B5;
        }

        .estadisticas .cartas .details-cartas .details2 h3{
            color: #000;
            font-size: 3rem;
        }

        .det1{
            background: #ff5733;
        }

        .det2 {
            background: #581845;
        }

        .det3 {
            background: #c70039;
        }

        .estadisticas .reportes{
            height: 20%;
            width: 100%;

            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .reportes_boton {
            background: #E52525;
            border-radius:5px;
            color: #fff;
            font-size: 1.5rem;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 1rem 2rem;
            text-decoration:none;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="caja">
            <div class="caja-izquierda">
                <div class="caja-izquierda-uno">
                    <h1>SearchJob</h1>
                    <!-----Validar si el usuario tiene subida alguna imagen de perfíl-------->
                    <?php
                        
                        if(is_null($_SESSION['admin']->imagen)){
                            $url_imagen = "../../uploads/usuarios_perfil/usuario.png";
                        }else{
                            $url_imagen = "../../uploads/usuarios_perfil/".$_SESSION['admin']->imagen;
                        }

                    ?>

                    <img src="<?=$url_imagen?>" alt="" class="imagen">
        
                    <h2><?=$_SESSION['admin']->nombre ?> <?=$_SESSION['admin']->apellido ?></h2>
                </div>
                <div class="caja-izquierda-dos">
                    <div class="caja-izquierda-dos-a"> 
                        <a href="adminRegistrar.php">Registrar Admin <span class="icon-folder"></span></a> 
                        <a href="administrarUsuarios.php">Administrar Usuarios <span class="icon-clipboard"></span></a>
                        <a href="../calificacion/indexCalificacion.php">Ver Comentarios <span class="icon-bubble"></span></a>
                        <a href="administrarTablas.php">Administrar Tablas <span class="icon-table"></span></a>
                        <a href="gestionarBD.php">Gestionar Base de Datos <span class="icon-database"></span></a>
                    </div>
                </div>
            </div>
            <div class="caja-derecha">
                <div class="details">
                    <a href="../notificaciones/notificacionesAdmin.php">Notificaciones <span class="icon-bell"></span></a>
                    <a href="datosAdmin.php">Datos Personales <span class="icon-address-book"></span></a>   
                    <a href="../../execute.php?controller=adminExecute&action=logout">Cerrar Sesión <span class="icon-exit"></span></a>   
                </div>    
                <div class="details1">
                    <h1>Bienvenido <?=$_SESSION['admin']->nombre ?></h1>
                    <p>En esta sesión podrás encontrar varias funcionalidades que te harán los procesos mucho mas cortos y cómodos, navega y esperamos
                        que sea de tu gusto</p>
                </div>
            </div>
        </div>
        <hr style="width: 90%; margin: 2rem auto;">
        <div class="estadisticas">
            <div class="cartas">

                <div class="details-cartas">
                    <div class="details1 det1">
                        <span class="icon-users"></span>
                        <h2>Usuarios Registrados</h2>
                    </div>
                    <div class="details2">
                        <h3><?=$contado->usuarios?></h3>
                    </div>
                </div>

                <div class="details-cartas">
                    <div class="details1 det2">
                        <span class="icon-office"></span>
                        <h2>Municipios Disponibles</h2>
                    </div>
                    <div class="details2">
                        <h3><?=$contado1->municipios?></h3>
                    </div>
                </div>

                <div class="details-cartas">
                    <div class="details1 det3">
                        <span class="icon-newspaper"></span>
                        <h2>Calificaciones del Sitio</h2>
                    </div>
                    <div class="details2">
                        <h3><?=$contado2->calificaciones?></h3>
                    </div>
                </div>

            </div>
            <div class="reportes">
                <a href="" class="reportes_boton"><span class="icon-flag"></span> Reportes</a>
            </div>
        </div>
    </div>
    
</body>
</html>