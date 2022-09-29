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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Postulaciones</title>
        <!-- Scrip que confirma la eliminación del empleo-->
        <script type="text/javascript">
            function ConfirmDelete()
            {
                var respuesta = confirm("¿Está seguro que desea eliminar este empleo?");

                if (respuesta == true){
                    return true;
                }
                else{
                    return false;
                }
            }
        </script>
</head>
<body>
    
    <div class="container-postulados">
        <div class="details">
            <?php 
                
                $postulaciones = new PostulacionDosController();
                $post = $postulaciones->obtenerPostulaciones();
        
            ?>
            <h2>Tus Postulaciones</h2>
            <?php   if(isset($_SESSION['complete']) && $_SESSION['complete'] == 'Complete'): ?>
                        
                        <strong>Postulación borrada de forma exitosa</strong>
                
            <?php   elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == 'Fail'):  ?>

                        <strong>Error al intentar borrar la postulación</strong>

            <?php   endif; ?>
            <p>
                Hola de nuevo <b><?=$_SESSION['empleado']->nombre?> <?=$_SESSION['empleado']->apellido?></b> !,
                en esta sesión puedes encontrar todas las postulaciones que has realizado, además de
                poder ver toda la información del empleo al que te postulaste solo dando click
                sobre su nombre. Puedes también eliminar tu postulación al mismo por X o Y motivo.
            </p>
            <table border="1">
                <tr>
                    <th>Nombre Empleo</th>
                    <th>Función</th>
                    <th>Vacantes</th>
                    <th>Descripción</th>
                    <th>Estado de la postulación</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
                <?php if($post->num_rows >= 1): ?>
                    <?php while($postulaciones = $post->fetch_object()): ?>
                <tr>
                    <td>
                        <a href="../empleo/verEmpleo.php?id=<?=$postulaciones->codigo?>&aut=tgfgdh"><?=$postulaciones->nombre ?></a>
                    </td>
                    <td><?=$postulaciones->funcion ?></td>
                    <td><?=$postulaciones->vacantes ?></td>
                    <td><?php echo substr($postulaciones->descripcion,0,80)."..."; ?></td>
                    <td><?=$postulaciones->estado ?></td>
                    <td><?=$postulaciones->fecha ?></td>
                    <td>
                    <a href="../../execute.php?controller=postulacion&action=eliminarPostulacion&usuario=<?=$_SESSION['empleado']->id ?>&empleo=<?=$postulaciones->codigo ?>" onclick="return ConfirmDelete()">Eliminar</a>
                    </td>
                </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Aún no te has postulado a ningún empleo!</p>
                    <a href="empleosBuscar.php">Hazlo Ahora!</a>
                <?php endif; ?>
            </table>
            <a href="indexUsuario.php">Volver</a>
            <?php borrarSesion('complete'); borrarSesion('fail'); ?>
        </div>
    </div>


</body>
</html>