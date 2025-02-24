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
            width: 90%;
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
            padding:1rem 1.5rem;
            text-align:center;
        }

        .container-postulados .details table tr td a.del{
            background: #EC1D1D;
            border-radius:5px;
            color: #fff;
            letter-spacing:1px;
            padding: 0.6rem;
            text-decoration:none;
        }

        .container-postulados .details table tr td a.blo{
            background: var(--primario);
            border-radius:5px;
            color: #fff;
            letter-spacing:1px;
            padding: 0.6rem;
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

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <a href="administrarUsuarios.php" class="icono-volver"><span class="icon-undo2"></span></a>
        <div class="details">
            <!-----Instancia para mostrar los empleos publicados por una empresa-------->
            <?php 

                $empleado = new AdminController();
                $emp = $empleado->conseguirEmpleados();
        
            ?>
            <h2>Usuario Registrados</h2>
            <!-----Validar si la sesión es de un fallo o exito (Cuando se elimina un empleo)-------->
            <?php if(isset($_SESSION['complete']) && $_SESSION['complete'] == "Complete"): ?>
                <b>Usuario Eliminado con exito</b>
            <?php elseif(isset($_SESSION['fail']) && $_SESSION['fail'] == "Fail"): ?>
                <b>Ocurrió un error al borrar el usuario</b>
            <?php endif; ?>
            <p>
                En está sesión puedes encontrar todos los empleados registrados a nuestro sitio web
            </p>
            <!-----Condición para validar si fallo el modificar un empleo o fue un exito-------->
            <?php   if(isset($_SESSION['bloquear']) && $_SESSION['bloquear'] == 'Fallido'): ?>
                        
                        <strong>Empleo modificado de forma exitosa</strong>
        
            <?php   endif; ?>
            <!-----Tabla que muestra todos los datos-------->
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Bloquear</th>
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
                            <!-----Link que bloquea un usuario-------->
                            <td><a href="../../execute.php?controller=usuario&action=bloquearUsuario&id=<?=$empleado->id?>&perfil=<?=$empleado->codigo_perfil?>" onclick="return ConfirmBlock()" class="blo">Bloquear</a></td>
                        </tr>
                    <?php endwhile; ?>
                <!-----Condición para validar cuando no hay registros-------->
                <?php elseif($emp->num_rows == 0): ?>
                    <p>Aún no hay usuarios postulados</p>
                <?php endif; ?>
            </table>
            <?php if($emp->num_rows >= 1 && isset($_POST)): ?>
                <a href="generarPdfEmpleados.php" class="pdf" target="_blank">Generar PDF</a>
            <?php endif; ?>
            <!-----Borrar todas las sesiones-------->
            <?php borrarSesion('errores'); borrarSesion('complete'); borrarSesion('fail');  borrarSesion('registro'); borrarSesion('registro_fail');?>
        </div>
    </div>
    <!-- Script que confirma la eliminación del empleo-->
    <script type="text/javascript">
        function ConfirmDelete()
        {
            var respuesta = confirm("¿Estás seguro que deseas eliminar este usuario? "+
            "Te recomendamos hacer esto en un caso de extrema importancia, ya que dentro de este "+
            "usuario pueden haber muchos otros procesos.");

            if (respuesta == true){
                return true;
            }
            else{
                return false;
            }
        }

        function ConfirmBlock()
        {
            var respuesta = confirm("¿Estás seguro que deseas bloquear a este usuario?");

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