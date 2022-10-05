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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Registrar Empleo</title>
    <style>

        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        body{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        .container-empleo{
            background: var(--primario);
            width: 100%;

            display:flex;
            align-items: center;
            justify-content: center;
        }

        .container-empleo .details{
            background: #fff;
            border-radius: 0.8rem;
            margin: 1.5rem;
            padding: 2rem;
            width: 60%;
        }

        .container-empleo .details h2{
            text-align: center;
        }

        .container-empleo .details label{
            width: 100%;
        }

        .container-empleo .details form input{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-empleo .details form select{
            display: block;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 100%;
        }

        .container-empleo .details form input[type="submit"]{
            background: var(--primario);
            border:none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
            display: block;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0 auto;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            padding: 0.4rem;
            width: 70%;
        }

        
        /*Aviso del span */
        .container-empleo .details form .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 0.5rem;
        }

        img{
            height: auto;
            width: 150px;
        }

        .icono-volver {
            background: var(--blanco);
            border-radius: 50%;
            color: var(--primario);
            padding: 1rem;
            position: absolute;
            left: 1rem;
            text-decoration: none;
            top: 1rem;
        }

    </style>
</head>
<body>

    <div class="container-empleo">
        <a href="indexEmpresa.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">

            <h2>Añade un Nuevo Empleo</h2>
            <!-----condición para validar que exista una sesión en caso de exito o fallo-------->
            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Empleo añadido de forma exitosa</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro de empleo fallido</strong>

            <?php   endif; ?>
            <!-----formulario para guardar un empleo-------->
            <form action="../../execute.php?controller=empleoExecute&action=guardarEmpleo" method="post" enctype="multipart/form-data">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

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

                <label for="direccion">Dirección</label>
                <input type="text" name="direccion">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

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

                <label for="vacantes">Vacantes</label>
                <input type="number" name="vacantes">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'vacantes') : ""; ?>

                <label for="jornada">Jornada</label>
                <input type="text" name="jornada">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'jornada') : ""; ?>

                <label for="experiencia">Experiencia</label>
                <input type="text" name="experiencia">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'experiencia') : ""; ?>

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

                <label for="funcion">Función</label>
                <input type="text" name="funcion">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'funcion') : ""; ?>

                <label for="empresa">Empresa</label>
                <input type="number" name="empresa" value="<?=$_SESSION['empresa']->id?>">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'empresa') : ""; ?>

                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'descripcion') : ""; ?>

                <label for="salario">Salario</label>
                <input type="number" name="salario">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'salario') : ""; ?>

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

                <label for="logo">Logo de la empresa</label>
                <input type="file" name="logo">
                <!-----Mostrar error en un campo en caso de que exista-------->
                <span class="aviso"><span class="icon-notification"></span> Recuerda añadir el logo de tu empresa</span>
                <input type="submit" value="Publicar Empleo">

            </form>
            <!-----Borrar todas las sesiones existentes-------->
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>
        </div>
    </div>
    
</body>
</html>