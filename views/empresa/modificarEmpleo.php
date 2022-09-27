<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../autoload.php";
    require_once "../../helpers/utils.php";
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
    <title>Modificar Empleo</title>
</head>
<body>

    <h1>Modicar Empleo</h1>

    <?php
    
        $empleo = new empleoController();
        $empleos = $empleo->detalleEmpleo();

    ?>
    
    <form action="../../execute.php?controller=empleoExecute&action=guardarEmpleo&modificar=1&codigo=<?=$empleos->codigo?>" method="post" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$empleos->nombre?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>
        <br>
        <label for="municipio">Municipio</label>
        <select name="municipio" id="">
            <?php 
                
                $municipio = new empleoController();
                $mun = $municipio->mostrarMunicipios();

            ?>
            <?php while($municipio = $mun->fetch_object()): ?>
                
                <option value="<?=$municipio->codigo ?>"  <?=isset($empleos) && is_object($empleos) && $municipio->codigo == $empleos->municipio ? 'selected' : ''; ?>>
                    <?=$municipio->nombre ?>
                </option>
            
            <?php

            endwhile;

            ?>
        </select>
        <br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" value="<?=$empleos->direccion?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>
        <br>
        <label for="cargo">Cargo</label>
        <select name="cargo" id="">
            <?php 
                
                $cargo = new empleoController();
                $carg = $cargo->mostrarCargos();

            ?>
            <?php while($cargo = $carg->fetch_object()): ?>
                
                <option value="<?=$cargo->codigo ?>" <?=isset($empleos) && is_object($empleos) && $cargo->codigo == $empleos->cargo ? 'selected' : ''; ?>>
                    <?=$cargo->nombre ?>
                </option>
            
            <?php

            endwhile;

            ?>
        </select>
        <br>
        <label for="vacantes">Vacantes</label>
        <input type="number" name="vacantes" value="<?=$empleos->vacantes?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'vacantes') : ""; ?>
        <br>
        <label for="jornada">Jornada</label>
        <input type="text" name="jornada" value="<?=$empleos->jornada?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'jornada') : ""; ?>
        <br>
        <label for="experiencia">Experiencia</label>
        <textarea name="experiencia" rows="10"><?=$empleos->experiencia?></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'experiencia') : ""; ?>
        <br>
        <label for="sector">Sector</label>
        <select name="sector" id="">
            <?php 
                
                $sector = new empleoController();
                $sect = $sector->mostrarSector();

            ?>
            <?php while($sector = $sect->fetch_object()): ?>
                
                <option value="<?=$sector->codigo ?>" <?=isset($empleos) && is_object($empleos) && $sector->codigo == $empleos->sector ? 'selected' : ''; ?>>
                    <?=$sector->nombre ?>
                </option>
            
            <?php

            endwhile;

            ?>
        </select>
        <br>
        <label for="funcion">Función</label>
        <input type="text" name="funcion" value="<?=$empleos->funcion?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'funcion') : ""; ?>
        <br>
        <label for="empresa">Empresa</label>
        <input type="number" name="empresa" value="<?=$_SESSION['empresa']->id?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'empresa') : ""; ?>
        <br>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" rows="10"><?=$empleos->descripcion?></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'descripcion') : ""; ?>
        <br>
        <label for="salario">Salario</label>
        <input type="number" name="salario" value="<?=$empleos->salario?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'salario') : ""; ?>
        <br>
        <label for="tipo_contrato">Tipo de Contrato</label>
        <select name="tipo_contrato" id="">
            <?php 
                
                $tipo = new empleoController();
                $contrato = $tipo->mostrarTipoContrato();

            ?>
            <?php while($tipo = $contrato->fetch_object()): ?>
                
                <option value="<?=$tipo->codigo ?>" <?=isset($empleos) && is_object($empleos) && $tipo->codigo == $empleos->tipo_contrato ? 'selected' : ''; ?>>
                    <?=$tipo->nombre ?>
                </option>
            
            <?php

            endwhile;

            ?>
        </select>
        <br>
        <label for="logo">Logo de la empresa</label>
        <input type="file" name="logo">
        <input type="hidden" name="logo_nombre" value="<?=$empleos->logo?>">
        <br>
        <input type="submit" value="Modificar">

    </form>
    <?php borrarSesion('errores'); ?>
</body>
</html>