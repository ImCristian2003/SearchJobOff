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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Detalle Empleo</title>
    <style>

        img{
            height: auto;
            width: 300px;
        }
        
    </style>
</head>
<body>
    
    <?php
    
        
        echo $empleos->codigo;
        echo "<br>";
        echo $empleos->nombre;
        echo "<br>";
        echo $empleos->nombre_municipio;
        echo "<br>";
        echo $empleos->direccion;
        echo "<br>";
        echo $empleos->nombre_cargo;
        echo "<br>";
        echo $empleos->vacantes;
        echo "<br>";
        echo $empleos->jornada;
        echo "<br>";
        echo $empleos->experiencia;
        echo "<br>";
        echo $empleos->nombre_sector;
        echo "<br>";
        echo $empleos->funcion;
        echo "<br>";
        echo $empleos->nombre_empresa;
        echo "<br>";
        echo $empleos->salario;
        echo "<br>";
        echo $empleos->nombre_tipocontrato;
        echo "<br>";
    ?>
    <!-----Condición para validar si el empleo tiene logo subido o no-------->
    
    
    

</body>
</html>