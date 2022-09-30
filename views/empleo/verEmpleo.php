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
    
        $empleo = new EmpleoController();
        $empleos = $empleo->detalleEmpleo();
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
        echo $empleos->descripcion;
        echo "<br>";
        echo $empleos->salario;
        echo "<br>";
        echo $empleos->nombre_tipocontrato;
        echo "<br>";
    ?>
    <!-----Condición para validar si el empleo tiene logo subido o no-------->
    <?php if($empleos->logo == "none"): ?>
        <img src="../../uploads/empleos_logo/empresa.png" alt="perfil_usuario">
    <?php else: ?>
        <img src="../../uploads/empleos_logo/<?=$empleos->logo?>" alt="perfil_usuario">
    <?php endif; ?>
    
    <!-----Condición para validar las vacantes de un empleo-------->
    <?php if($empleos->vacantes == 0): ?>
        <p>
            Lo sentimos, pero parece que esta oferta de empleo ya no cuenta con
            vacantes disponibles
        </p>
    <!-----Condición para validar que halla un usuario empleado logeado y se postule-------->
    <?php elseif(isset($_SESSION['empleado']) && isset($_GET['id']) && !isset($_GET['aut'])): ?>
        <form action="../usuario/usuarioPostular.php" method="post">
            <input type="hidden" value="<?=$empleos->codigo?>" name="codigo">
            <input type="hidden" value="<?=$empleos->nombre?>" name="empleo">
            <input type="submit" value="Postularme">
        </form>
    <!-----Condición para validar cuando un usuario ya se halla postulado a un empleo-------->
    <?php elseif(isset($_SESSION['empleado']) && isset($_GET['id']) && isset($_GET['aut'])): ?>
        <a href="../usuario/usuarioPostulaciones.php">Volver</a>
    <!-----Condición cuando no está logeado-------->
    <?php else:?>
        <p>Ups! Parece que no estás registrado</p>
    <?php endif; ?>

</body>
</html>