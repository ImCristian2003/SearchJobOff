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
    <title>Registrar Empleo</title>
</head>
<body>

    <div class="container-empleo">
        <div class="details">

            <h2>Añade un Nuevo Empleo</h2>

            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Empleo añadido de forma exitosa</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro de empleo fallido</strong>

            <?php   endif; ?>

            <form action="../../execute.php?controller=empleoExecute&action=guardarEmpleo" method="post" enctype="multipart/form-data">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>
                <br>
                <label for="municipio">Municipio</label>
                <select name="municipio" id="">
                    <?php 
                        
                        $municipio = new empleoController();
                        $mun = $municipio->mostrarMunicipios();

                    ?>
                    <?php while($municipio = $mun->fetch_object()): ?>
                        
                        <option value="<?=$municipio->codigo ?>">
                            <?=$municipio->nombre ?>
                        </option>
                    
                    <?php

                    endwhile;

                    ?>
                </select>
                <br>
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>
                <br>
                <label for="cargo">Cargo</label>
                <select name="cargo" id="">
                    <?php 
                        
                        $cargo = new empleoController();
                        $carg = $cargo->mostrarCargos();

                    ?>
                    <?php while($cargo = $carg->fetch_object()): ?>
                        
                        <option value="<?=$cargo->codigo ?>">
                            <?=$cargo->nombre ?>
                        </option>
                    
                    <?php

                    endwhile;

                    ?>
                </select>
                <br>
                <label for="vacantes">Vacantes</label>
                <input type="number" name="vacantes">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'vacantes') : ""; ?>
                <br>
                <label for="jornada">Jornada</label>
                <input type="text" name="jornada">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'jornada') : ""; ?>
                <br>
                <label for="experiencia">Experiencia</label>
                <input type="text" name="experiencia">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'experiencia') : ""; ?>
                <br>
                <label for="sector">Sector</label>
                <select name="sector" id="">
                    <?php 
                        
                        $sector = new empleoController();
                        $sect = $sector->mostrarSector();

                    ?>
                    <?php while($sector = $sect->fetch_object()): ?>
                        
                        <option value="<?=$sector->codigo ?>">
                            <?=$sector->nombre ?>
                        </option>
                    
                    <?php

                    endwhile;

                    ?>
                </select>
                <br>
                <label for="funcion">Función</label>
                <input type="text" name="funcion">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'funcion') : ""; ?>
                <br>
                <label for="empresa">Empresa</label>
                <input type="number" name="empresa" value="<?=$_SESSION['empresa']->id?>">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'empresa') : ""; ?>
                <br>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'descripcion') : ""; ?>
                <br>
                <label for="salario">Salario</label>
                <input type="number" name="salario">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'salario') : ""; ?>
                <br>
                <label for="tipo_contrato">Tipo de Contrato</label>
                <select name="tipo_contrato" id="">
                    <?php 
                        
                        $tipo = new empleoController();
                        $contrato = $tipo->mostrarTipoContrato();

                    ?>
                    <?php while($tipo = $contrato->fetch_object()): ?>
                        
                        <option value="<?=$tipo->codigo ?>">
                            <?=$tipo->nombre ?>
                        </option>
                    
                    <?php

                    endwhile;

                    ?>
                </select>
                <br>
                <label for="logo">Logo de la empresa</label>
                <input type="file" name="logo">
                <br>
                <input type="submit" value="Enviar">

            </form>
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>
        </div>
    </div>
    
</body>
</html>