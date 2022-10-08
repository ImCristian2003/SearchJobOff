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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Buscar Empleos</title>
    <style>

        body{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }

        .container{
            width:100%;
            height:100vh;

            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content:center;
            text-align:center;
        }

        .container .perfil{
            height: 23%;
            padding: 1rem;
        }

        .container .perfil img{
            border-radius:50%;
            width:13rem;
        }

        .container .descripcion {
            height: 20%;
            margin: 3rem;
        }

        .container .descripcion h2 {
            font-size: 2rem;
        }

        .form {
            height: 50%;
        }

        .form form {
            display: flex;
            justify-content: center;
        }

        .form form input[type="text"] {
            border: 1px solid #000;
            border-right: 1px solid rgb(121, 120, 120);
            border-bottom-left-radius: 15px;
            border-top-left-radius: 15px;
            padding: 1rem 2rem;
            width: 35%;
        }

        .form form select {
            border: 1px solid #000;
            border-left: none;
            border-bottom-right-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1rem 2rem;
            width: 35%;
        }

        .form form input[type="submit"] {
            margin: 1rem;
        
        }

        .icono-volver {
            background: var(--primario);
            border-radius: 50%;
            color: #fff;
            padding: 1rem;
            position: absolute;
            left: 1.5rem;
            text-decoration: none;
            top: 1.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container">
        <a href="indexUsuario.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="perfil">
            <!-----Validar si el usuario tiene subida alguna imagen de perfíl-------->
            <?php
            
            if(is_null($_SESSION['empleado']->imagen) || empty($_SESSION['empleado']->imagen)){
                $url_imagen = "../../uploads/usuarios_perfil/usuario.png";
            }else{
                $url_imagen = "../../uploads/usuarios_perfil/".$_SESSION['empleado']->imagen;
            }

            ?>

            <img src="<?=$url_imagen?>" alt="" class="imagen">            
        </div>
        <div class="descripcion">
            <h2>Bienvenido</h2>
            <p>
                En esta sesión puedes buscar un empleo que se acomode, ya sea a tu lugar de residencia o al empleo
                que busques. Recuerda que para postularte a un empleo debes estár registrado
                y cargar tu hoja de vida para que así las empresa puedan ver toda tú
                información y contratarte!
            </p>
        </div>
        <div class="form">

            <form action="../empleo/buscarEmpleo.php" method="post">
                <input type="text" placeholder="Busqueda manual" name="nombre">
                <select name="id">
                    <option value="0">Todos</option>
                    <!-----Instancia para traer todos los municipios-------->
                    <?php 
                        
                        $municipio = new empleoController();
                        $mun = $municipio->mostrarMunicipios();

                    ?>
                    <!-----Ciclo que muestra todos los municipios-------->
                    <?php while($municipio = $mun->fetch_object()): ?>
                        
                        <option value="<?=$municipio->codigo ?>">
                            <?=$municipio->nombre ?>
                        </option>
                    
                    <?php

                    endwhile;

                    ?>
                </select>
                <input type="submit" value="Buscar">
            </form>

        </div>
    </div>

</body>
</html>