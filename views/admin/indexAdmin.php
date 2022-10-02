<?php

    session_start();
    require_once "../../config/conexion.php";
    if(!isset($_SESSION['admin'])){
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
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
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
            font-family:Arial, Helvetica, sans-serif;
            font-size: 1.7rem;
            height: 50%;
            padding: 2rem;
        }
        .caja .caja-izquierda .caja-izquierda-dos .caja-izquierda-dos-a a{
            margin: .4rem;
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
            width: 70%;

            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
        }

        .caja .caja-derecha .caja-derecha-details h1{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 3rem;
        }
        .caja .caja-derecha .caja-derecha-details p{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5rem;
            margin: 2rem;
        }
    </style>
</head>
<body>
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
                    <a href="verEmpleados.php">Ver Empleados <span class="icon-clipboard"></span></a>
                    <a href="../calificacion/indexCalificacion.php">Ver Comentarios <span class="icon-bubble"></span></a>
                    <a href="administrarTablas.php">Administrar Tablas <span class="icon-bubble"></span></a>
                </div>
                <div class="caja-izquierda-dos-aa">
                    <a href="datosAdmin.php">Datos Personales <span class="icon-address-book"></span></a>   
                    <a href="../../execute.php?controller=adminExecute&action=logout">Cerrar Sesión <span class="icon-exit"></span></a>   
                </div>    
            </div>
        </div>
        <div class="caja-derecha">
            <div class="caja-derecha-details">
                <h1>Bienvenido <?=$_SESSION['admin']->nombre ?></h1>
                <p>En esta sesión podrás encontrar varias funcionalidades que te harán los procesos mucho mas cortos y cómodos, navega y esperamos
                    que sea de tu gusto</p>
            </div>
        </div>
    </div>
    
</body>
</html>