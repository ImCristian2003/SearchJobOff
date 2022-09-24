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
    <title>Document</title>
    <style>

        .container {
            height: 100vh;
            width: 100%;

            display: flex;
            flex-direction: row;
        }

        .busqueda {
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

        .empleos {
            width: 70%;
        }

        img{
            height: auto;
            width: 20%;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="busqueda">
            <form action="">
                <input type="text" name="busqueda" id="" placeholder="Buscar empleo">
            </form>
            <div class="iconos">
                <span class="icon-facebook"></span>
                <span class="icon-instagram"></span>
                <span class="icon-twitter"></span>
                <span class="icon-whatsapp"></span>
            </div>
            <div class="volver">
                <?php if(isset($_SESSION['empleado'])): ?>
                    <a href="../usuario/empleosBuscar.php">Volver</a>
                <?php else: ?>
                    <a href="../../index.php">Volver</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="empleos">
            <?php 
                
                $empleo = new EmpleoController();
                $emp = $empleo->mostrarEmpleos();
                
            ?>
            <?php if($emp->num_rows >= 1): ?>
                <?php while($empleos = $emp->fetch_object()): ?>
                    <div class="details-empleo">
                        <div class="img">

                            <?php if($empleos->logo == "sin_logo"): ?>
                                <img src="../../uploads/empleos_logo/empresa.png" alt="perfil_usuario">
                            <?php else: ?>
                                <img src="../../uploads/empleos_logo/<?=$empleos->logo?>" alt="perfil_usuario">
                            <?php endif; ?>

                        </div>
                        <div class="nombre-empleo">
                            <h2><?=$empleos->nombre?></h2>
                            <ul>
                                <li><?=$empleos->direccion?></li>
                                <li><?=$empleos->empresa?></li>
                                <li><?=$empleos->jornada?></li>
                                <li><?=$empleos->salario?></li>
                                <li><?=$empleos->municipio?></li>
                            </ul>
                        </div>
                        <a href="verEmpleo.php?id=<?=$empleos->codigo?>">Ver empleo</a>
                    </div>
                <?php endwhile; ?> 
            <?php else: ?>
                <h2>Aún no hay empleos disponibles</h2>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>