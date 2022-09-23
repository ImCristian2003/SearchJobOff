<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empleado'])){
        header("Location: ../../index.php");
    }

?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulación Empleo</title>
</head>
<body>
    
    <div class="container-postulacion">
        <div class="details">

            <h1>Postulación</h1>
            <form action="../../execute.php?controller=postulacion&action=guardarPostulacion" method="post">

                <label for="">Usuario</label>
                <input type="text" name="usuario" value="<?=$_SESSION['empleado']->id?>">
                <label for="">Empleo</label>
                <input type="text" name="empleo" value="<?=$_POST['codigo']?>">

                <input type="submit" value="Postularme">

            </form>

        </div>
    </div>

</body>
</html>