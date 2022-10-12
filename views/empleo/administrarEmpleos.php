<?php 
    session_start();
    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['admin'])){
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
    <title>Notificaciones</title>
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
            width:  80%;
        }

        .container-postulados .details table tr td, th{
            border: 1px solid #000;
            border-collapse: collapse;
            caption-side: bottom;
            padding: 1rem;
            text-align: center;
            vertical-align: top;
        }

        .container-postulados .details table tr th{
            background: var(--primario);
            border: none;
            color: #fff;
            letter-spacing:1px;
        }

        .container-postulados .details table tr td{ 
            align-items:center;
            border: none;
            justify-content:center;
            padding:1rem 1rem;
            text-align:center;
        }

        .container-postulados .details table tr td a.reportar{
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
            margin: 1rem;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

        .pdf{
            background: red;
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

        .icono-volver {
            background: var(--primario);
            border-radius: 50%;
            color: var(--blanco);
            padding: 1rem;
            position: absolute;
            left: 1.5rem;
            text-decoration: none;
            top: 1.5rem;
        }

        td a.reportado{
            background: red;
            border-radius:5px;
            color: #fff;
            letter-spacing:1px;
            padding: 0.6rem;
            text-decoration:none;
        }

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <a href="../admin/administrarTablas.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <!-----Instancia para mostrar los postulados a un empleo------->
            <?php 
                
                $empleos = new EmpleoController();
                $emp = $empleos->mostrarEmpleosAdm();
                
            ?>
            <h2>Empleos Registrados</h2>
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Reporte eliminado con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al querer eliminar el reporte</b>
            <?php endif; ?>

            <?php if(isset($_SESSION['reporte']) && $_SESSION['reporte'] == "Complete"): ?>
                <b>Empleo reportado con exito</b>
            <?php elseif(isset($_SESSION['reporte_fail']) && $_SESSION['reporte_fail'] == "Fail"): ?>
                <b>Reporte de empleo fallido</b>
            <?php endif; ?>

            <p>
                En esta sesión puedes encontrar todos los empleos registrados
                en la base de datos.
            </p>
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Vacantes</th>
                    <th>Experiencia</th>
                    <th>Función</th>
                    <th>Empresa</th>
                    <th>Descripción</th>
                    <th>Salario</th>
                    <th>Reportar</th>
                </tr>
                <!-----condición para validar que exista una sesión-------->
                <?php if(isset($_SESSION['admin'])): ?>
                    <!-----condición para validar que exista un registro-------->
                    <?php if($emp != false): ?>
                        <!-----ciclo para mostrar los campos-------->
                        <?php while($empleos = $emp->fetch_object()): ?>
                    <tr>
                        <td><?=$empleos->codigo ?></td>
                        <td><?=$empleos->nombre ?></td>
                        <td><?=$empleos->nombre_municipio ?></td>
                        <td><?=$empleos->direccion ?></td>
                        <td><?=$empleos->vacantes ?></td>
                        <td><?=$empleos->experiencia ?></td>
                        <td><?=$empleos->funcion ?></td>
                        <td><?=$empleos->nombre_empresa ?></td>
                        <td><?=$empleos->descripcion ?></td>
                        <td><?=number_format($empleos->salario, 0, ",", ".") ?></td>
                        <?php 
                            //Validar si una empresa está reportada
                            $reporte = new NotificacionController();
                            $reportes = $reporte->validarReporte($empleos->id_empresa);
                            
                        ?>
                        <?php if($reportes): ?>
                            <td><a href="../../execute.php?controller=notificacionExecute&action=eliminarReporte&codigo=<?=$empleos->id_empresa ?>" class="reportado" onclick="return ConfirmDeleteReport()">Reportado</a></td>
                        <?php else: ?>
                            <td><a href="../notificaciones/crearNotificacion.php?empresa=<?=$empleos->id_empresa ?>&codigo_emp=<?=$empleos->codigo?>&nombre_emp=<?=$empleos->nombre ?>" onclick="return ConfirmDelete()" class="reportar">Reportar</a></td>
                        <?php endif; ?>
                    </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Aún no hay notificaciones registradas</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Aún no hay notificaciones registradas</p>
                <?php endif; ?>
            </table>
            <!-- <a href="registrarCargo.php" class="volver">Registrar Cargo</a> -->
            <!--Validar que hayan campos para generar el PDF-->
            <?php if($emp != false >= 1 && isset($_POST)): ?>
                <a href="generarPdfEmpleos.php" class="pdf" target="_blank">Generar PDF</a>
            <?php endif; ?>
            <?php borrarSesion('complete'); borrarSesion('fail'); borrarSesion('reporte'); borrarSesion('reporte_fail');?>
        </div>
    </div>

    <!-- Script que confirma la eliminación del empleo-->
    <script type="text/javascript">
        function ConfirmDelete()
        {
            var respuesta = confirm("¿Está seguro que desea reportar este empleo?");

            if (respuesta == true){
                return true;
            }
            else{
                return false;
            }
        }
        function ConfirmDeleteReport()
        {
            var respuesta = confirm("¿Está seguro que desea quitar el reporte de este empleo?");

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