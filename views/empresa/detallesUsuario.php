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
    <title>Detalles Usuario</title>
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

        .container-detalles{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-detalles .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;

            display:flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .container-detalles .details a{
            background: red;
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            padding: 0.4rem 1.5rem;
            text-decoration:none;
        }

        .container-detalles .details .volver{
            background: var(--primario);
            border: none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

        img{
            margin: 1.5rem;
            width: 10rem;
        }

    </style>
</head>
<body>
    
    <div class="container-detalles">
        <div class="details">
            <!-----Instancia para mostrar los detalles de un usuario-------->
            <?php 
                
                $detalle = new PostulacionDosController();
                $det = $detalle->detallesUsuario();
        
            ?>
            <!-----Veirificar si el usuario tiene una imagen subida o no-------->
            <?php
                
                if(is_null($det->imagen)){
                    $url_imagen = "../../uploads/usuarios_perfil/usuario.png";
                }else{
                    $url_imagen = "../../uploads/usuarios_perfil/".$det->imagen;
                }

            ?>
            <img src="<?=$url_imagen?>" alt="">
            <!-----Mostrar los datos-------->
            <p><b>Identificación: </b> <?=$det->id?></p>
            <p><b>Nombre Completo: </b><?=$det->nombre?> <?=$det->apellido?></p>
            <p><b>Telefono: </b><?=$det->telefono?></p>
            <p><b>Dirección Residencial: </b><?=$det->direccion?></p>
            <p><b>Correo: </b><?=$det->correo?></p>
            <!-----Mostrar la hoja de vida del usuario correspondiente-------->
            <p><a href="../../uploads/hojas_de_vida/<?=$det->hoja_vida?>" target="_blank"><span class="icon-paste"></span> Ver Hoja de Vida</a></p>
            <form action="postulados.php" method="post">
                <input type="hidden" value="<?=$_SESSION['empresa']->id ?>" name="empresa">
                <input type="submit" value="Volver" class="volver">
            </form>

        </div>
    </div>

</body>
</html>