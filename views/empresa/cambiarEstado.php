<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['empresa'])){
        header('Location: ../../index.php');
    } 

    var_dump($_POST);

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Estado</title>
</head>
<body>
    
    <div class="container-estado">
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