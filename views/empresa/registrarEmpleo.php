<?php

    session_start();
    require_once "../../config/conexion.php";
    require_once "../../autoload.php";
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

            <form action="../../execute.php?controller=empleoExecute&action=guardarEmpleo" method="post" enctype="multipart/form-data">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre">
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
                <br>
                <label for="jornada">Jornada</label>
                <input type="text" name="jornada">
                <br>
                <label for="experiencia">Experiencia</label>
                <input type="text" name="experiencia">
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
                <br>
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" value="<?=$_SESSION['empresa']->id?>">
                <br>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion">
                <br>
                <label for="salario">Salario</label>
                <input type="number" name="salario">
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

        </div>
    </div>
    
</body>
</html>