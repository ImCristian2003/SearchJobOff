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
    <title>Generar Reportes</title>
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

        .container{
            display:flex;
            flex-wrap:wrap;
            justify-content:space-around;
        }

        .container .reportes{
            box-shadow: 0.3rem 0.3rem 3px #A39790;
            margin: 2rem 1rem;
            width: 40%;
        }

        .container .reportes .head{
            background: var(--primario);
            padding: 0.5rem;
        }

        .container .reportes .head h2{
            color: #fff;
            letter-spacing:1px;
        }

        .container .reportes .body1{
            padding: 1rem;
        }

        .container .reportes .body1 form select{
            padding: 0.5rem;
            width: 50%;
        }

        .container .reportes .body1 form label{
            margin-right: 3rem;
        }

        .container .reportes .body1 form input[type="submit"]{
            cursor:pointer;
            padding: 0.3rem 1rem;
        }

        .container .reportes .body2{
            padding: 1rem;
        }

        .container .reportes .body2 form input[type="date"]{
            padding:0.5rem;
        }

        .container .reportes .body2 form input[type="submit"]{
            cursor:pointer;
            padding: 0.3rem 1rem;
            margin-left: 1.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container">
        <!-----------REPORTE PARA LA TABLA CALIFICACIONES(ESTRELLAS)--------------->
        <div class="reportes">
            <div class="head">
                <h2>Reporte de calificaciones con: </h2>
            </div>
            <div class="body1">
                <form action="" method="post">
                    <select name="calificacion" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label for="calificacion">Estrellas</label>
                    <input type="submit" value="Ver">
                </form>
            </div>
        </div>
        <!-----------REPORTE PARA LA TABLA CALIFICACIONES(ESTRELLAS)--------------->
        <div class="reportes">
            <div class="head">
                <h2>Reporte de calificaciones con: </h2>
            </div>
            <div class="body2">
                <form action="" method="post">
                    <label for="">Fechas entre el </label>
                    <input type="date" name="fecha_inicial">
                    <label for=""> y el </label>
                    <input type="date" name="fecha_final">
                    <input type="submit" value="Ver">
                </form>
            </div>
        </div>
        <!-----------REPORTE PARA LA TABLA CALIFICACIONES(ESTRELLAS)--------------->
        <div class="reportes">
            <div class="head">
                <h2>Reporte de calificaciones con: </h2>
            </div>
            <div class="body">
                <form action="" method="post">
                    <select name="calificacion" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label for="calificacion">Estrellas</label>
                </form>
            </div>
        </div>
    </div>

</body>
</html>