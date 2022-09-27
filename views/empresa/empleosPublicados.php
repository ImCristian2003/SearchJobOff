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
    <title>Empleos Publicados</title>
</head>
<body>
    
    <div class="container-postulados">
        <div class="details">
            <?php 

                $empleos = new EmpleoController();
                $emp = $empleos->empleosPublicados();
        
            ?>
            <h2>Empleos Publicados</h2>
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Empleo Eliminado con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al borrar el empleo</b>
            <?php endif; ?>
            <p>
                En está sesión puedes encontrar todos los empleos publicados por
                <b><?=$_SESSION['empresa']->nombre?></b>
            </p>
            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Empleo modificado de forma exitosa</strong>
                
            <?php   elseif((isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail') || isset($_SESSION['errores'])):  ?>
        
                        <strong>Intento de modificar fallido, asegurate de haber
                            puesto todos los campos con el formato correcto</strong>
        
            <?php   endif; ?>
            <table border="1">
                <tr>
                    <th>Nombre</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Cargo</th>
                    <th>Vacantes</th>
                    <th>Jornada</th>
                    <th>Experiencia</th>
                    <th>Sector</th>
                    <th>Función</th>
                    <th>Descripción</th>
                    <th>Salario</th>
                    <th>Tipo Contrato</th>
                    <th>Moficar</th>
                    <th>Eliminar</th>
                </tr>
                <?php if(!is_null($emp) && $emp->num_rows >= 1): ?>
                    <?php while($empleo = $emp->fetch_object()): ?>
                        <tr>
                            <td><?=$empleo->nombre ?></td>
                            <td><?=$empleo->nombre_municipio ?></td>
                            <td><?=$empleo->direccion ?></td>
                            <td><?=$empleo->nombre_cargo ?></td>
                            <td><?=$empleo->vacantes ?></td>
                            <td><?=$empleo->jornada ?></td>
                            <td><?=$empleo->experiencia ?></td>
                            <td><?=$empleo->nombre_sector ?></td>
                            <td><?=$empleo->funcion ?></td>
                            <td><?php echo substr($empleo->descripcion,0,80)."..."; ?></td>
                            <td><?=number_format($empleo->salario, 0, ",", ".") ?></td>
                            <td><?=$empleo->nombre_tipocontrato ?></td>
                            <td>
                                <form action="modificarEmpleo.php" method="post">
                                    <input type="hidden" value="<?=$empleo->codigo?>" name="id">
                                    <input type="submit" value="Modificar">
                                </form>
                            </td>
                            <td><a href="../../execute.php?controller=empleoExecute&action=eliminarEmpleo&id=<?=$empleo->codigo?>">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php elseif($emp->num_rows == 0): ?>
                    <p>Aún no hay usuarios postulados</p>
                <?php endif; ?>
            </table>
            <?php borrarSesion('errores'); borrarSesion('complete'); borrarSesion('fail');  borrarSesion('registro'); borrarSesion('registro_fail');?>
            <a href="indexEmpresa.php">Volver</a>
        </div>
    </div>

</body>
</html>