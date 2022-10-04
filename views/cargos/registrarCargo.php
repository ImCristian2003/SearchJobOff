<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['admin'])){
        header('Location: ../../index.php');
    }

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
    <title>Registrar Municipio</title>
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

        .container-municipio{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-municipio .details{
            background: var(--blanco);
            border-radius: 1rem;
            padding: 3rem;
            width: 80%;

            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .container-municipio .details form{
            margin: 1rem auto;
            width: 100%;
        }

        .container-municipio .details form label{
            display: block;
            margin: auto;
            width: 80%;
        }

        .container-municipio .details form input{
            display: block;
            margin: 1rem auto;
            padding: 0.3rem;
            width: 80%;
        }

        .container-municipio .details form select{
            display: block;
            margin: 1rem auto;
            padding: 0.3rem;
            width: 80%;
        }

        .container-municipio .details form input[type="submit"]{
            background: var(--primario);
            border: none;
            border-radius: 0.5rem;
            color: #fff;
            cursor:pointer;
            font-size: 1.3rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 2rem auto;
            padding: 0.4rem;
            width: 50%;
        }

        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            padding: 1rem;
            position: absolute;
            left: 1.5rem;
            text-decoration: none;
            top: 1.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container-municipio">
        <a href="indexCargo.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">

            <h2>Registrar un Cargo</h2>
            <!--En caso de haber una sesión de fallo o exito, mostrar un mensaje--->
            <?php   if(isset($_SESSION['complete']) && $_SESSION['complete'] == 'Complete'): ?>
                        
                        <strong>Cargo añadido exitosamente</strong>
                
            <?php   elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == 'Fail'):  ?>

                        <strong>Error al querer añadir el cargo</strong>

            <?php   endif; ?>
            <p>
                Bienvenido <b> <?=$_SESSION['admin']->nombre?></b>, en esta sesión puedes
                registrar un cargo que va estar disponible en nuestro sitio web.
            </p>
            <form action="../../execute.php?controller=cargoExecute&action=guardarCargo" method="post">

                <label for="nombre">Nombre del Cargo</label>
                <input type="text" name="nombre">
                <!---en caso de haber un error en un campo, mostrar el mensaje correspondiente--->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <input type="submit" value="Registrar">

            </form>
            <?php borrarSesion('complete'); borrarSesion('fail'); borrarSesion('errores'); ?>

        </div>
    </div>

</body>
</html>