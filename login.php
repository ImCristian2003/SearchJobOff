<?php 

    //Inicia la sesión
    session_start();

    //Clase que ayudará a cargar automaticamente todos los controladores
    require_once "autoload.php"; 
    //Conexión a la base de datos
    require_once 'config/conexion.php';
    //Librería de funciones
    require_once 'helpers/utils.php';

    if(isset($_SESSION['empleado'])){
        header("Location: views/usuario/indexUsuario.php");
    }

    if(isset($_SESSION['empresa'])){
        header("Location: views/empresa/indexEmpresa.php");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" href="assets/icons/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>login</title>
    <style>

        *{
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container{
            background: linear-gradient(to left,rgba(105, 183, 185, .8), rgb(0, 0, 0, .8)), 
            url(../assets/img/login.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            width: 100%;

            display: flex;
        }

        .details1{
            color: #fff;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .details1 h2{
            font-size: 40px;
            margin: 50px 10px;
        }

        .details1 ul {
            list-style-type: none;
            text-align: left;
        }

        .details1 ul li {
            font-size: 20px;
            margin: 20px 10px;
        }

        .details1 ul span {
            color: chartreuse;
            font-size: 23px;
            margin: 10px 10px;
        }

        .details2{
            background: rgba(105, 183, 185, 1);
            position: relative;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .details2 a span {
            background: #fff;
            border-radius: 50%;
            color: rgba(105, 183, 185, 1);
            padding: 10px;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .details2 h2 {
            color: #fff;
            letter-spacing: 2px;
            font-size: 40px;
            margin: 30px 10px;
        }

        .details2 .details-form {
            width: 90%;
        }

        .details2 form {
            padding: 20px;

            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .details2 form label {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .details2 form input[type="text"], input[type="password"] {
            color: #fff;
            font-size: 18px;
            margin: 20px 10px;
            padding: 5px;
            width: 100%;

            background: transparent;
            border: none;
            border-radius: 0px;
            border-bottom: 2px solid #fff;
        }

        .details2 form input[type="submit"] {
            background: #B8B8B8;
            border: none;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 18px 10px;
            padding: 10px 20px;
            width: 30%;
        }

        .details2 p {
            color: rgb(255, 255, 255);
            margin: 20px 10px;
        }

        .details2 p a {
            color: rgb(255, 255, 255);
            letter-spacing: 1px;
            text-decoration: none;
        }

        .details2 a {
            color: rgb(255, 255, 255);
            font-weight: bold;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .sesion_fallida{
            background: red;
            border-radius: 5px;
            color: #fff;
            padding: 5px 8px;
        }

    </style>
</head>
<body>
   
    <div class="container">
        <div class="details1">
            <div class="details-advantages">
                <h2>¿Que ventajas tendrás si te registras?</h2>
                <ul>
                    <li>
                        <span class="icon-checkmark"></span> 
                        Interfaz grafica confiable e intuitiva
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Búsqueda rapida y sencilla de trabajo
                    </li>
                    <li>
                        <span class="icon-checkmark"></span>
                        Registro gratuito, fácil y rápido con el que podrás acceder a todas las funciones
                    </li>
                </ul>
            </div>
        </div>
        <div class="details2">
            <a href="index.php"><span class="icon-cross"></span></a>
            <div class="details-form">
                <h2>Iniciar Sesión</h2>
                <?php if(isset($_SESSION['fail']) && $_SESSION['fail'] == "Inicio de Sesión Fallido"): ?>
                    <p class="sesion_fallida">Inicio de Sesión fallido</p>
                <?php endif; ?>
                <form action="execute.php?controller=usuario&action=login" method="post">
                    <label for="id">Identificación</label>
                    <input type="text" name="id">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena">
                    <input type="submit" value="Iniciar Sesión">
                </form>
                <?php borrarSesion('fail'); ?>
                <p>No tienes una cuenta? <b><a href="registro.html">Regístrate</a></b></p>
                <a href="">Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>

</body>
</html>