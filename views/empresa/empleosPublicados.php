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
    <title>Empleos Publicados</title>
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
            height: 15rem;
        }

        .container-postulados .details {
            margin: 2rem auto;
            text-align: center;
            width: 98%;
        }

        .container-postulados .details table{
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            border: 1px solid #000;
            margin: 2rem auto;
        }

        .container-postulados .details table tr td, th{
            border: 1px solid #000;
            border-collapse: none;
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
            border: none;
            justify-content:center;
            padding:1rem 0rem;
            text-align:center;
        }

        .container-postulados .details table tr td a{
            background: red;
            border-radius:50%;
            color: #fff;
            letter-spacing:1px;
            padding: 0.6rem;
            text-decoration:none;
        }

        .modificar {
            background: var(--primario);
            border: none;
            border-radius:5px;
            color: #fff;
            cursor: pointer;
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
        .details table{
            border-left:none;
        }
        .details table td{
            border:
        }
        .details th{
            align-items:center;
            justify-content:center;
            padding:1rem 0rem;
            text-align:center;
            border:0;
        }
        .details tr td{
            border:none;
        }
        .icono-volver {
            background: var(--primario);
            border-radius: 50%;
            color: var(--blanco);
            padding: 1rem;
            position: absolute;
            left: 1rem;
            text-decoration: none;
            top: 1rem;
        }
        .container-postulados .details .pdf{
            background: red;
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <a href="indexEmpresa.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <!-----Instancia para mostrar los empleos publicados por una empresa-------->
            <?php 

                $empleos = new EmpleoController();
                $emp = $empleos->empleosPublicados();
        
            ?>
            <h2>Empleos Publicados</h2>
            <!-----Validar si la sesión es de un fallo o exito (Cuando se elimina un empleo)-------->
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Empleo Eliminado con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al borrar el empleo</b>
            <?php endif; ?>
            <p>
                En está sesión puedes encontrar todos los empleos publicados por
                <b><?=$_SESSION['empresa']->nombre?></b>
            </p>
            <!-----Condición para validar si fallo el modificar un empleo o fue un exito-------->
            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Empleo modificado de forma exitosa</strong>
                
            <?php   elseif((isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail') || isset($_SESSION['errores'])):  ?>
        
                        <strong>Intento de modificar fallido, asegurate de haber
                            puesto todos los campos con el formato correcto</strong>
        
            <?php   endif; ?>
            <!-----Tabla que muestra todos los datos-------->
            <table cellspacing="0" cellpadding="0" >
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
                <!-----Validar que hayan registros-------->
                <?php if(!is_null($emp) && $emp->num_rows >= 1): ?>
                    <!-----ciclo que muestra todos los datos-------->
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
                                <!-----formulario para modificar los datos de un empleo-------->
                                <form action="modificarEmpleo.php" method="post">
                                    <input type="hidden" value="<?=$empleo->codigo?>" name="id">
                                    <input type="submit" value="Modificar" class="modificar">
                                </form>
                            </td>
                            <!-----Link que elimina un empleo-------->
                            <td><a href="../../execute.php?controller=empleoExecute&action=eliminarEmpleo&id=<?=$empleo->codigo?>" onclick="return ConfirmDelete()"><span class="icon-cross"></span></a></td>
                        </tr>
                    <?php endwhile; ?>
                <!-----Condición para validar cuando no hay registros-------->
                <?php elseif($emp->num_rows == 0): ?>
                    <p>Aún no hay usuarios postulados</p>
                <?php endif; ?>
            </table>
            <!---Verificar que hayan registros para generar el PDF-->
            <?php if($emp->num_rows >= 1 && isset($_POST)): ?>
                <a href="generarPdfEmpleos.php" class="pdf" target="_blank">Generar Reporte</a>
            <?php endif; ?>
            <!-----Borrar todas las sesiones-------->
            <?php borrarSesion('errores'); borrarSesion('complete'); borrarSesion('fail');  borrarSesion('registro'); borrarSesion('registro_fail');?>
        </div>
    </div>
    <!-- Script que confirma la eliminación del empleo-->
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
</body>
</html>