<?php 

    //Inicia la sesión
    session_start();

    //Clase que ayudará a cargar automaticamente todos los controladores
    require_once "../../autoload.php"; 
    //Conexión a la base de datos
    require_once '../../config/conexion.php';
    //Librería de funciones
    require_once '../../helpers/utils.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Empleos</title>
</head>
<body>
    
    <div class="container">
        <div class="perfil">
            <img src="" alt="">            
        </div>
        <div class="descripcion">
            <h2>Bienvenido</h2>
            <p>
                En esta sesión puedes buscar un empleo que se acomode, ya sea a tu lugar de residencia o al empleo
                que busques.
            </p>
        </div>
        <div class="form">

            <form action="../empleo/buscarEmpleo.php" method="post">
                <input type="text" placeholder="Busqueda manual" name="nombre">
                <select name="id">
                    <option value="0">Todos</option>
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
                <input type="submit" value="Enviar">
            </form>

        </div>
    </div>

</body>
</html>