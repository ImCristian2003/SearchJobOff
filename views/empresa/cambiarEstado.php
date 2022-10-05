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
    <title>Cambiar Estado</title>
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

        .container-estado{
            background: var(--primario);
            height: 100vh;
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-estado .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;
        }

        .container-estado .details h2{
            text-align: center;
        }

        .container-estado .details label{
            width: 100%;
        }

        .container-estado .details form select{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-estado .details form input[type="submit"]{
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

        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            padding: 1rem;
            position: absolute;
            left: 1rem;
            text-decoration: none;
            top: 1rem;
        }

    </style>
</head>
<body>
    
    <div class="container-estado">
        <a href="postulados.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <h2>Cambiar el estado de la postulación</h2>
            <form action="../../execute.php?controller=postulacion&action=cambiarEstado" method="post">
                <select name="estado" id="">
                    <option value="rechazado">Rechazado</option>
                    <option value="aprobado">Aprobado</option>
                </select>
                <!-----Campos paa validar el cambio de estado de una postulación-------->
                <input type="hidden" name="codigo" value="<?=$_POST['id']?>">
                <input type="hidden" name="empleo" value="<?=$_POST['empleo']?>">
                <input type="hidden" name="vacantes" value="<?=$_POST['vacantes']?>">
                <input type="submit" value="Cambiar">
            </form>

        </div>
    </div>

</body>
</html>