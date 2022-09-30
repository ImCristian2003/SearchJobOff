<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Usuarios Postulados</title>
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

        .container-postulados{
            width: 100%;
        }

        .container-postulados .details {
            margin: 2rem auto;
            text-align: center;
            width: 95%;
        }

        .container-postulados .details table{
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            margin: 2rem auto;
        }

        .container-postulados .details table tr td, th{
            border: 1px solid #000;
            border-collapse: collapse;
            caption-side: bottom;
            padding: 0.5rem;
            text-align: left;
            vertical-align: top;
        }

        .container-postulados .details table tr th{
            background: var(--primario);
            color: #fff;
            letter-spacing:1px;
        }

        .container-postulados .details table tr td{ 
            align-items:center;
            justify-content:center;
            padding:1rem 0rem;
            text-align:center;
        }

        .container-postulados .details table tr td a{
            background: var(--primario);
            border-radius:5px;
            color: #fff;
            letter-spacing:1px;
            padding: 0.6rem;
            text-decoration:none;
        }

        .container-postulados .details .volver{
            background: var(--primario);
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <div class="details">
            <!-----Instancia para mostrar los postulados a un empleo------->
            <?php 
                
                $postulacion = new PostulacionDosController();
                $post = $postulacion->obtenerPostulados();
                
            ?>
            <h2>Usuarios postulados a tu empresa</h2>
            <p>
                En esta sesión puedes encontrar todos los usuarios que se han postulado
                a alguna oferta laboral publicada por <b><?=$_SESSION['empresa']->nombre?></b>,
                si haces click sobre el dato del usuario, podrás visualizar algunos
                de sus datos personales para poder entrar en contacto con el, además de poder
                descargar su hoja de vida y cambiar el estado de la postulación a:<b> Recibido,
                Contratado ó Rechazado. (Lo puedes cambiar solo dando click sobre el propio
                estado)</b>
            </p>
            <table border="1">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre del Empleo</th>
                    <th>Vacantes</th>
                    <th>Función</th>
                    <th>Descripción</th>
                    <th>Estado de la postulación</th>
                    <th>Fecha</th>
                </tr>
                <!-----condición para validar que exista una sesión-------->
                <?php if(isset($_SESSION)): ?>
                    <!-----condición para validar que exista un registro-------->
                    <?php if($post->num_rows >= 1 && isset($_POST)): ?>
                        <!-----ciclo para mostrar los campos-------->
                        <?php while($postulacion = $post->fetch_object()): ?>
                    <tr>
                        <td>
                            <!-----formulario para ver la información de un usuario postulado-------->
                            <form action="detallesUsuario.php" method="post">
                                <input type="hidden" name="id" value="<?=$postulacion->id ?>">
                                <input type="submit" value="<?=$postulacion->usuario ?> - <?=$postulacion->id ?>">
                            </form>
                        </td>
                        <td><?=$postulacion->empleo ?></td>
                        <td><?=$postulacion->vacantes ?></td>
                        <td><?=$postulacion->funcion ?></td>
                        <td><?php echo substr($postulacion->descripcion,0,40)."..."; ?></td>
                        <td>
                            <!-----formulario para cambiar el estado de una postulacion-------->
                            <form action="cambiarEstado.php" method="post">
                                <input type="hidden" name="id" value="<?=$postulacion->codigo_postulacion ?>">
                                <input type="hidden" name="empleo" value="<?=$postulacion->codigo_empleo ?>">
                                <input type="hidden" name="vacantes" value="<?=$postulacion->vacantes ?>">
                                <input type="submit" value="<?=$postulacion->estado?>">
                            </form>
                        </td>
                        <td><?=$postulacion->fecha ?></td>
                    </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Aún no hay usuarios postulados</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Aún no hay usuarios postulados</p>
                <?php endif; ?>
            </table>
            <a href="indexEmpresa.php" class="volver">Volver</a>
        </div>
    </div>

</body>
</html>