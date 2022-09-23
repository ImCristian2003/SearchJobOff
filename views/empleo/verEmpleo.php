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
    <style>
        img{
            height: auto;
            width: 300px;
        }
    </style>
</head>
<body>
    
    <?php
    
        $empleo = new EmpleoController();
        $empleos = $empleo->detalleEmpleo();
        echo $empleos->codigo;
        echo "<br>";
        echo $empleos->nombre;
        echo "<br>";
        echo $empleos->municipio;
        echo "<br>";
        echo $empleos->direccion;
        echo "<br>";
        echo $empleos->cargo;
        echo "<br>";
        echo $empleos->vacantes;
        echo "<br>";
        echo $empleos->jornada;
        echo "<br>";
        echo $empleos->experiencia;
        echo "<br>";
        echo $empleos->sector;
        echo "<br>";
        echo $empleos->funcion;
        echo "<br>";
        echo $empleos->empresa;
        echo "<br>";
        echo $empleos->descripcion;
        echo "<br>";
        echo $empleos->salario;
        echo "<br>";
        echo $empleos->tipo_contrato;
        echo "<br>";
    ?>

    <?php if($empleos->logo == "none"): ?>
        <img src="../../uploads/empleos_logo/empresa.png" alt="perfil_usuario">
    <?php else: ?>
        <img src="../../uploads/empleos_logo/<?=$empleos->logo?>" alt="perfil_usuario">
    <?php endif; ?>

    <?php if(isset($_SESSION['empleado'])): ?>
        <form action="../usuario/usuarioPostular.php" method="post">
            <input type="hidden" value="<?=$empleos->codigo?>" name="codigo">
            <input type="hidden" value="<?=$empleos->nombre?>" name="nombre">
            <input type="submit" value="Postularme">
        </form>
    <?php else:?>
        <p>Ups! Parece que no estás registrado</p>
    <?php endif; ?>

</body>
</html>