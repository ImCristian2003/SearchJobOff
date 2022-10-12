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
            width:  98%;
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

        td span.caducada{
            background: red;
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 0.6rem 1.5rem;
        }

        td span.atiempo{
            background: green;
            border-radius:5px;
            color: #fff;
            font-weight:bold;
            letter-spacing:2px;
            margin: 1rem;
            padding: 0.6rem 1.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <a href="../admin/administrarTablas.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <!-----Instancia para mostrar los postulados a un empleo------->
            <?php 
                
                $notificaciones = new NotificacionController();
                $not = $notificaciones->conseguirNotificaciones();
                //Sacar la fecha actual
                $DateAndTime = date('Y-m-d', time());
                //Función para calcular los días, meses y años que han pasado entre
                //2 fechas
                function calcularTiempo($fecha_inicio,$fecha_fin){
                    //Proceso para crear los valores que se restan
                    $datetime1 = date_create($fecha_inicio);
                    $datetime2 = date_create($fecha_fin);
                    //Función para restar las fechas
                    $intervalo = date_diff($datetime1,$datetime2);
                    //Array para devolver los datos
                    $tiempo = array();
                    //Ciclo para imprimir los datos
                    foreach ($intervalo as $valor) {
                        $tiempo[] = $valor;
                    }
                    //Retorno de los valores
                    return $tiempo;
            
                }
                
            ?>
            <h2>Notificaciones Registradas</h2>
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Notificación Eliminada con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al querer borrar la notificación</b>
            <?php endif; ?>
            <p>
                En esta sesión puedes encontrar todos las notificaciones registradas
                en la base de datos.
            </p>
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Codigo</th>
                    <th>Usuario - Identificación</th>
                    <th>Asunto</th>
                    <th>Cuerpo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Estado de Caducidad</th>
                    <th>Eliminar</th>
                </tr>
                <!-----condición para validar que exista una sesión-------->
                <?php if(isset($_SESSION['admin'])): ?>
                    <!-----condición para validar que exista un registro-------->
                    <?php if($not != false): ?>
                        <!-----ciclo para mostrar los campos-------->
                        <?php while($notificaciones = $not->fetch_object()): ?>
                    <tr>
                        <td><?=$notificaciones->codigo ?></td>
                        <td><?=$notificaciones->nombre_usuario ?> - <?=$notificaciones->id ?></td>
                        <td><?=$notificaciones->asunto ?></td>
                        <td><?=$notificaciones->cuerpo ?></td>
                        <!-----Calcular el tiempo---->
                        <?php  
                            $fecha_not = $notificaciones->fecha;
                        ?>
                        <td>
                            <?php 
                                $datos = calcularTiempo($fecha_not,$DateAndTime); 
                                if($datos[2] <= 0){
                                    echo "Ha pasado menos de un día";
                                }else{
                                    echo "Han pasado ".$datos[2]." días.";
                                }
                            ?>
                        </td>
                        <td><?=$notificaciones->estado ?></td>
                        <?php if($datos[2] >= 8 ): ?>
                            <td><span class="caducada">Caducada!</span></td>
                        <?php else: ?>
                            <td><span class="atiempo">Disponible!</span></td>
                        <?php endif; ?>
                        <td><a href="../../execute.php?controller=notificacionExecute&action=eliminarNotificacion&id=<?=$notificaciones->codigo?>" onclick="return ConfirmDelete()">Eliminar</a></td>
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
            <?php if($not != false >= 1 && isset($_POST)): ?>
                <a href="generarPdfNotificaciones.php" class="pdf" target="_blank">Generar PDF</a>
            <?php endif; ?>
            <?php borrarSesion('complete'); borrarSesion('fail'); ?>
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