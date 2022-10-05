<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    //Instancia para traer todos los campos de un empleo
    $empleo = new EmpleoController();
    $empleos = $empleo->detalleEmpleo();

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
    <link rel="stylesheet" href="css/estilosbuscador.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <title>Buscar Empleo</title>
    <style>
        *{
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
            display: flex;

            height: 100vh;
            width: 100%;
        }

        .caja-principal{
            display: flex;
            text-align: center;
            justify-content: center;
            flex-direction:column;

            height: 100vh;
            width: 70%;
        }
        .caja-principal .uno{
            height: 50%;
            width: 100%;

            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        .caja-principal .uno h2{
            font-size: 2.5rem;
        }
        .caja-principal .uno p{
            font-size: 1.4rem;
            margin: 2rem;
        }
        .caja-principal .dos{
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            background-color: var(--primario);
            border-radius: 10% 50% 50% 10%;
            height: 50vh;
            width: 100%;
        }
        .caja-principal .dos h2{
            color: #fff;
            font-size: 2.4rem;
        }
        .caja-principal .dos .requerimientos{
            display: flex;
            flex-direction: column;
            
            color: var(--blanco);
            font-size: 1.6rem;
            list-style-type: none;
            margin: 1.6rem;
            padding: 1rem;
        }
        .caja-principal .dos li{
            margin: 0.5rem;
        }
        .caja-principal .dos li strong{
            letter-spacing: 1px;
        }
        .caja-principal .icon-undo2{
            background-color: var(--primario);
            border-radius: 2rem;
            height: 3rem;
            width: 3rem;
            left: 15px;
            position: absolute;
            top: 15px;
            color: var(--blanco);

            display: flex;
            align-items: center;
            justify-content: center;
        }
        .caja-secundaria{
            height: 100vh;
            width: 30%;

            display: flex;
            flex-direction: column;
            justify-content: right; 
            align-items:center ;
            text-align: center;   
        }
        .caja-secundaria .empleo{
            background-color: #69B7B9;
            border-radius: 23% 0 20% 40%;
            height: 40vh;
            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;
        }
        .caja-secundaria .empleo img{
            border-radius: 50%;
            height: 13rem;
            width: 15rem;
        }
        .caja-secundaria .detalles{
            height: 40vh;
            width: 100%;
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            align-items: center;
        }
        .caja-secundaria .detalles h2{
            font-size: 1.7rem;
            font-weight: bold;
        }
        .caja-secundaria .detalles li{
            font-size: 1.2rem;
            list-style-type: none;
            margin: 1.2rem;
        }
        .icon-checkmark{
            color: #69B7B9;
            left: 0;
            margin-right: 1.2rem;
        }
        .caja-secundaria .boton{
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;

            background-color: #fff;
            border-radius: 2rem;
            color: #fff;
            height: 12vh;
            padding: 1rem;
            width: 60%;
            position: relative;
        
        }
        .caja-secundaria .boton p{
            background: red;
            border-radius: 1rem;
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            letter-spacing: 1px;
            padding: 0.5rem;
        }

        .caja-secundaria .boton form input[type="submit"]{
            background: var(--primario);
            border: none;
            border-radius: 1rem;
            color: #fff;
            cursor: pointer;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 2px;
            padding: 1rem 2rem;
        }

        .volver {
            background: var(--primario);
            border-radius: 1rem;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 2px;
            padding: 1rem 2rem;
            text-decoration: none;
        }

    </style>    
</head>
<body>
    <div class="container">
        <div class="caja-principal">
            <?php if(isset($_SESSION['empleado']) && isset($_GET['ret'])): ?>
                <a href="../usuario/usuarioPostulaciones.php"><span class="icon-undo2"></span></a>
            <?php elseif(isset($_SESSION['empleado']) && !isset($_GET['ret'])): ?>
                <a href="../usuario/empleosBuscar.php"><span class="icon-undo2"></span></a>
            <?php else: ?>
                <a href="../../index.php"><span class="icon-undo2"></span></a>
            <?php endif; ?>
            <div class="uno">
                <h2>Descripción del Empleo.</h2>
                <p><?=$empleos->descripcion; ?></p>
            </div>
            <div class="dos">
                <h2>Requerimientos</h2>
                <ul class="requerimientos">
                    <li> <strong>Experiencia: </strong> <?=$empleos->experiencia; ?></li>
                    <li> <strong>Jornada: </strong> <?=$empleos->jornada; ?></li>
                    <li> <strong>Función:</strong> <?=$empleos->funcion; ?></li>
                </ul>
            </div>
        </div>
        <div class="caja-secundaria">
            <div class="empleo">
                <!---IMPRIMIR LA IMAGEN DEL EMPLEO-->
            <?php if($empleos->logo == "none" || $empleos->logo == "sin_logo"): ?>
                <img src="../../uploads/empleos_logo/empresa.png" alt="perfil_usuario">
            <?php else: ?>
                <img src="../../uploads/empleos_logo/<?=$empleos->logo?>" alt="perfil_usuario">
            <?php endif; ?>
            </div>
            <div class="detalles">
                <h2>Características del empleo.</h2>
                <ul>
                    <li><span class="icon-checkmark"></span>Salario de <?=number_format($empleos->salario, 0, ",", ".") ?></li>
                    <li><span class="icon-checkmark"></span><?=$empleos->nombre_tipocontrato; ?></li>
                    <li><span class="icon-checkmark"></span>Cargo: <?=$empleos->nombre_cargo; ?></li>
                </ul>
            </div>
            <div class="boton">
                <!-----Condición para validar las vacantes de un empleo-------->
                <?php if($empleos->vacantes == 0): ?>
                    <p>
                        Lo sentimos, pero esta oferta de empleo ya no cuenta con
                        vacantes disponibles
                    </p>
                <!-----Condición para validar que halhayala un usuario empleado logeado y se postule-------->
                <?php elseif(isset($_SESSION['empleado']) && isset($_GET['id']) && !isset($_GET['aut'])): ?>
                    <form action="../usuario/usuarioPostular.php" method="post">
                        <input type="hidden" value="<?=$empleos->codigo?>" name="codigo">
                        <input type="hidden" value="<?=$empleos->nombre?>" name="empleo">
                        <input type="submit" value="Postularme">
                    </form>
                <!-----Condición para validar cuando un usuario ya se haya postulado a un empleo-------->
                <?php elseif(isset($_SESSION['empleado']) && isset($_GET['id']) && isset($_GET['aut'])): ?>
                    <a href="../usuario/usuarioPostulaciones.php" class="volver">Volver</a>
                <!-----Condición cuando no está logeado-------->
                <?php else:?>
                    <p>Ups! Parece que no estás registrado</p>
                <?php endif; ?>     
            </div>

        </div>
    </div>

</body>
</html> 