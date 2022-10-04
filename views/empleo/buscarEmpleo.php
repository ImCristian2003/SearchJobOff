<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Document</title>
    <style>

        body{
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        .container {
            width: 100%;

            display: flex;
            flex-direction: row;
        }

        .busqueda {
            height:100vh;
            width: 30%;

            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .busqueda form{
            margin: 30px 10px;
            width: 80%;
        }
        .busqueda form input[type="text"]{
            border: 1px solid #434343;
            border-radius: 10px;
            font-size: 20px;
            padding: 10px 17px;
            width: 100%;
        }

        .busqueda .iconos {
            width: 80%;
            height: 50%;

            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: space-around;
            text-align: center;
        }

        .busqueda .iconos span {
            background: rgba(105, 183, 185, 1);
            border-radius: 10px;
            color: #fff;
            font-size: 25px;
            padding: 15px;
        }

        .busqueda .volver a {
            background: rgba(105, 183, 185, 1);
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            padding: 1rem 2rem;
            text-decoration: none;
        }

        .empleos {
            background: var(--primario);
            width: 70%;

            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content:center;
        }

        .empleos .details-empleo{
            background: var(--blanco);
            border-radius:5px;
            margin: 1rem;
            height: 15rem;
            width:80%;

            display:flex;
        }

        .empleos .details-empleo .img{
            width: 30%;
        }

        .empleos .details-empleo .img img{
            border-bottom-left-radius: 8px;
            border-top-left-radius: 8px;
            height: 100%;
            width: 100%;
        }

        .empleos .details-empleo .nombre-empleo{
            width: 50%;

            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content:center;
        }

        .empleos .details-empleo .nombre-empleo ul{
           list-style-type: none;
        }

        .empleos .details-empleo .nombre-empleo ul li{
           margin: 0.3rem;
        }

        .empleos .details-empleo .ver-empleo{
           background: var(--gris);
           border-top-right-radius: 8px;
           border-bottom-right-radius: 8px;
           width: 20%;

           display:flex;
           align-items:center;
           flex-direction:column;
           justify-content:center;
        }

        .empleos .details-empleo .ver-empleo a{
            color: #fff;
           font-size:2.5rem;
           text-decoration:none;
        }

        .vacio {
            color: #fff;
            font-size: 2rem;
            letter-spacing: 1px;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="busqueda">
            <div class="iconos">
                <span class="icon-facebook"></span>
                <span class="icon-instagram"></span>
                <span class="icon-twitter"></span>
                <span class="icon-whatsapp"></span>
            </div>
            <div class="volver">
                <!-----Condición para validar quien está logeado-------->
                <?php if(isset($_SESSION['empleado'])): ?>
                    <a href="../usuario/empleosBuscar.php">Volver</a>
                <?php else: ?>
                    <a href="../../index.php">Volver</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="empleos">
            <!-----Instancia para traer los registros de la tabla empleo-------->
            <?php 
                
                $empleo = new EmpleoController();
                $emp = $empleo->mostrarEmpleos();
                
            ?>
            <!-----Condición para validar que halla por lo menos un registro-------->
            <?php if($emp->num_rows >= 1): ?>
                <!-----Ciclo que imprime todos los datos-------->
                <?php while($empleos = $emp->fetch_object()): ?>
                    <div class="details-empleo">
                        <div class="img">
                            <!-----Condición para validar si el empleo tiene o no un logo-------->
                            <?php if($empleos->logo == "sin_logo" || empty($empleos->logo)): ?>
                                <img src="../../uploads/empleos_logo/empresa.png" alt="perfil_usuario">
                            <?php else: ?>
                                <img src="../../uploads/empleos_logo/<?=$empleos->logo?>" alt="perfil_usuario">
                            <?php endif; ?>

                        </div>
                        <div class="nombre-empleo">
                            <h2><?=$empleos->nombre?></h2>
                            <ul>
                                <li><b>Ubicación:</b> <?=$empleos->direccion?></li>
                                <li><b>Jornada</b> <?=$empleos->jornada?></li>
                                <li><b>Salario de</b> <?=number_format($empleos->salario, 0, ",", ".") ?></li>
                                <li><b>Vacantes Disponibles:</b> <?=$empleos->vacantes?></li>
                            </ul>
                        </div>
                        <div class="ver-empleo">
                            <!-----Vinculo que lleva a la pagina para detallar de mejor manera el empleo-------->
                            <a href="verEmpleo.php?id=<?=$empleos->codigo?>"><span class="icon-circle-right"></span></a>
                        </div>
                    </div>
                <?php endwhile; ?> 
            <!-----en caso de que no halla un solo registro-------->
            <?php else: ?>
                <h2 class="vacio">Aún no hay empleos disponibles</h2>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>