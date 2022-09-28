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
    <title>Usuarios Postulados</title>
</head>
<body>
    
    <div class="container-postulados">
        <div class="details">
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
                <?php if(isset($_SESSION)): ?>
                    <?php if($post->num_rows >= 1 && isset($_POST)): ?>
                        <?php while($postulacion = $post->fetch_object()): ?>
                    <tr>
                        <td>
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
            <a href="indexEmpresa.php">Volver</a>
        </div>
    </div>

</body>
</html>