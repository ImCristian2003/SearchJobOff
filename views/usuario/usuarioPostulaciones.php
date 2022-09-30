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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/icons/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Mis Postulaciones</title>
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
            <?php 
                //Instancia que trae todas las postulaciones de un usuario
                $postulaciones = new PostulacionDosController();
                $post = $postulaciones->obtenerPostulaciones();
        
            ?>
            <h2>Tus Postulaciones</h2>
            <!-----Condición que evalua si existe una sesión de fallo o exito-------->
            <?php   if(isset($_SESSION['complete']) && $_SESSION['complete'] == 'Complete'): ?>
                        
                        <strong>Postulación borrada de forma exitosa</strong>
                
            <?php   elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == 'Fail'):  ?>

                        <strong>Error al intentar borrar la postulación</strong>

            <?php   endif; ?>
            <p>
                Hola de nuevo <b><?=$_SESSION['empleado']->nombre?> <?=$_SESSION['empleado']->apellido?></b>!,
                en esta sesión puedes encontrar todas las postulaciones que has realizado, además de
                poder ver toda la información del empleo al que te postulaste solo dando click
                sobre su nombre. Puedes también eliminar tu postulación al mismo por X o Y motivo.
            </p>
            <table border="1" border-collapse='collapse' border-spacing=''>
                <tr>
                    <th>Nombre Empleo</th>
                    <th>Función</th>
                    <th>Vacantes</th>
                    <th>Descripción</th>
                    <th>Estado de la postulación</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
                <!-----condicion que valida que exista almenos un registro-------->
                <?php if($post->num_rows >= 1): ?>
                <!-----ciclo que muestra todos los datos de la postulación-------->
                    <?php while($postulaciones = $post->fetch_object()): ?>
                <tr>
                    <td>
                        <a href="../empleo/verEmpleo.php?id=<?=$postulaciones->codigo?>&aut=tgfgdh"><?=$postulaciones->nombre ?></a>
                    </td>
                    <td><?=$postulaciones->funcion ?></td>
                    <td><?=$postulaciones->vacantes ?></td>
                    <!-----Cortar la descripcion a 80 caracteres maximo-------->
                    <td><?php echo substr($postulaciones->descripcion,0,80)."..."; ?></td>
                    <td><?=$postulaciones->estado ?></td>
                    <td><?=$postulaciones->fecha ?></td>
                    <td>
                    <!-----Link para eliminar una postulación-------->
                    <a href="../../execute.php?controller=postulacion&action=eliminarPostulacion&usuario=<?=$_SESSION['empleado']->id ?>&empleo=<?=$postulaciones->codigo ?>" onclick="return ConfirmDelete()">Eliminar</a>
                    </td>
                </tr>
                    <?php endwhile; ?>
                <!-----En caso de que el usuario no tenga ninguna postulación-------->
                <?php else: ?>
                    <p>Aún no te has postulado a ningún empleo!</p>
                    <a href="empleosBuscar.php">Hazlo Ahora!</a>
                <?php endif; ?>
            </table>
            <a href="indexUsuario.php" class="volver">Volver</a>
            <!-----funciones para borrar las sesiones existentes-------->
            <?php borrarSesion('complete'); borrarSesion('fail'); ?>
        </div>
    </div>
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
</body>
</html>