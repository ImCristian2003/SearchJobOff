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
            <!-----Instancia para mostrar los empleos publicados por una empresa-------->
            <?php 

                $empleado = new AdminController();
                $emp = $empleado->conseguirEmpleados();
        
            ?>
            <h2>Empleados registrados</h2>
            <!-----Validar si la sesión es de un fallo o exito (Cuando se elimina un empleo)-------->
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Empleo Eliminado con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al borrar el empleo</b>
            <?php endif; ?>
            <p>
                En está sesión puedes encontrar todos los empleados registrados a nuestro sitio web
            </p>
            <!-----Condición para validar si fallo el modificar un empleo o fue un exito-------->
            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Empleo modificado de forma exitosa</strong>
                
            <?php   elseif((isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail') || isset($_SESSION['errores'])):  ?>
        
                        <strong>Intento de modificar fallido, asegurate de haber
                            puesto todos los campos con el formato correcto</strong>
        
            <?php   endif; ?>
            <!-----Tabla que muestra todos los datos-------->
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Eliminar</th>
                </tr>
                <!-----Validar que hallan registros-------->
                <?php if(!is_null($emp) && $emp->num_rows >= 1): ?>
                    <!-----ciclo que muestra todos los datos-------->
                    <?php while($empleado = $emp->fetch_object()): ?>
                        <tr>
                            <td><?=$empleado->id ?></td>
                            <td><?=$empleado->nombre ?></td>
                            <td><?=$empleado->apellido ?></td>
                            <td><?=$empleado->telefono ?></td>
                            <td><?=$empleado->direccion ?></td>
                            <td><?=$empleado->correo ?></td>
                            <td><?=$empleado->nombre_perfil ?></td>
                            <!-----Link que elimina un empleo-------->
                            <td><a href="../../execute.php?controller=usuario&action=eliminarUsuario&id=<?=$empleado->id?>&perfil=<?=$empleado->codigo_perfil?>" onclick="return ConfirmDelete()">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                <!-----Condición para validar cuando no hay registros-------->
                <?php elseif($emp->num_rows == 0): ?>
                    <p>Aún no hay usuarios postulados</p>
                <?php endif; ?>
            </table>
            <!-----Borrar todas las sesiones-------->
            <?php borrarSesion('errores'); borrarSesion('complete'); borrarSesion('fail');  borrarSesion('registro'); borrarSesion('registro_fail');?>
            <a href="indexEmpresa.php" class="volver">Volver</a>
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