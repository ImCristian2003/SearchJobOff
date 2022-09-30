<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    if(!isset($_SESSION['empleado'])){
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
    <title>Cambiar Contraseña</title>
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

        .container-cambiar{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-cambiar .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;
        }

        .container-cambiar .details h2{
            text-align: center;
        }

        .container-cambiar .details label{
            width: 100%;
        }

        .container-cambiar .details form input{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-cambiar .details form input[type="submit"]{
            background: var(--primario);
            border:none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
            display: block;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 1rem auto;
            margin-top: 2rem;
            padding: 0.4rem;
            width: 70%;
        }
        /*Aviso del span */
        .container-cambiar .details form .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 0.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container-cambiar">
        <div class="details">

            <h2>Cambia tu contraseña</h2>
            <!-----Condición para mostrar una sesión en caso de error-------->
            <?php   if(isset($_SESSION['error']) && $_SESSION['error'] == 'Error'): ?>
                        
                        <strong>Error al querer modificar la contraseña, verifica bien los datos</strong>

            <?php   endif; ?>
            <!-----formulario para cambiar la contraseña-------->
            <form action="../../execute.php?controller=usuario&action=cambiarContrasena" method="post">
                <!-----Campos para cambiar la contraseña-------->
                <input type="hidden" name="empleado" value="<?=isset($_SESSION['empleado']) ? $_SESSION['empleado']->id : ""; ?>">
                <input type="hidden" name="empresa" value="<?=isset($_SESSION['empresa']) ? $_SESSION['empresa']->id : ""; ?>" >

                <label for="actual">Contraseña Actual</label>
                <input type="text" name="actual">

                <label for="nueva">Contraseña Nueva</label>
                <input type="text" name="nueva">

                <input type="submit" value="Cambiar">

            </form>
            <!-----Función para borrar una sesión-------->
            <?php borrarSesion('error');  ?>

        </div>
    </div>
    <script>

        alert("Si modificas tu contraseña tendrás que volver a Iniciar Sesión");

    </script>
</body>
</html>