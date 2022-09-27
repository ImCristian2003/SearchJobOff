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
    <title>Detalles Usuario</title>
    <style>

        img{
            width: 300px;
        }

    </style>
</head>
<body>
    
    <div class="container-detalles">
        <div class="details">

            <?php 
                
                $detalle = new PostulacionDosController();
                $det = $detalle->detallesUsuario();
        
            ?>
            
            <?php

                if(is_null($det->imagen)){
                    $url_imagen = "../../uploads/usuarios_perfil/usuario.png";
                }else{
                    $url_imagen = "../../uploads/usuarios_perfil/".$det->imagen;
                }

            ?>
            <img src="<?=$url_imagen?>" alt="">
            <p><?=$det->id?></p>
            <p><?=$det->nombre?></p>
            <p><?=$det->apellido?></p>
            <p><?=$det->telefono?></p>
            <p><?=$det->direccion?></p>
            <p><?=$det->correo?></p>
            <p><?=$det->hoja_vida?></p>
            <form action="postulados.php" method="post">
                <input type="hidden" value="<?=$_SESSION['empresa']->id ?>" name="empresa">
                <input type="submit" value="Volver"><span class="icon-paste"></span> 
            </form>

        </div>
    </div>

</body>
</html>