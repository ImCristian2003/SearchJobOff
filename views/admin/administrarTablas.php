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
    <title>Administrar Tablas</title>
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

        .administrar-tablas{
            height: 100vh;
            width: 100%;
        }

        .administrar-tablas .details{
            background: var(--primario);
            height: 100%;
            width: 100%;

            display: flex;
            flex-direction: column;
        }

        .administrar-tablas .details .bienvenida{
            background: var(--primario);
            /* border-bottom-left-radius:2rem;
            border-bottom-right-radius:2rem; */
            height: 50%;
            width: 100%;

            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .administrar-tablas .details .bienvenida h1{
            color: #fff;
            font-size: 3rem;
            letter-spacing: 2px;
        }

        .administrar-tablas .details .bienvenida p{
            color: #fff;
            font-size: 1.5rem;
        }

        .administrar-tablas .details .tablas{
            background: var(--blanco);
            border-top-left-radius:4rem;
            border-top-right-radius:4rem;
            height: 50%;
            width: 100%;

            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            text-align: center;
        }

        .administrar-tablas .details .tablas a{
            background: #000;
            border-radius: 0.5rem;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 1rem 2rem;
            padding: 1rem 2rem;
            text-decoration: none;
        }

    </style>
</head>
    <body>
        
        <div class="administrar-tablas">
            <div class="details">
                <div class="bienvenida">

                    <h1>Bienvenido Admin</h1>
                    <p>
                        En esta sesión puedes administrar todas las tablas de la base
                        de datos SearchJob, puedes tanto agregar como eliminar registros de 
                        las mismas.
                    </p>

                </div>
                <div class="tablas">

                    <a href="../municipios/indexMunicipio.php">Municipios - Veredas <span class="icon-address-book"></span></a>
                    <a href="datosAdmin.php">Departamentos <span class="icon-address-book"></span></a>
                    <a href="datosAdmin.php">Cargos <span class="icon-address-book"></span></a>
                    <a href="datosAdmin.php">Perfiles <span class="icon-address-book"></span></a>
                    <a href="datosAdmin.php">Sectores <span class="icon-address-book"></span></a>
                    <a href="datosAdmin.php">Tipos de Contrato <span class="icon-address-book"></span></a>

                </div>
            </div>
        </div>
        
    </body>
</html>