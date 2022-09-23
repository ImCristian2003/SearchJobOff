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
    <title>Detalle Empleo</title>
</head>
<body>
    
    <?php
    
        $empleo = new EmpleoController();
        $empleos = $empleo->detalleEmpleo();
        echo $empleos->nombre;

    ?>

</body>
</html>