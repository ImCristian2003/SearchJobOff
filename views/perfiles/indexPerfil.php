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
    <title>Municipios</title>
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
            padding: 0.5rem;
            text-align: center;
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
            margin: 1rem;
            padding: 0.6rem 1.5rem;
            text-decoration:none;
        }

        .aviso{
            background: rgba(235, 40, 40, 1);
            border-radius: 4px;
            color: #fff;
            display: block;
            margin: 1rem;
            padding: 0.5rem;
        }

    </style>
</head>
<body>
    
    <div class="container-postulados">
        <div class="details">
            <!-----Instancia para mostrar los postulados a un empleo------->
            <?php 
                
                $perfil = new PerfilController();
                $per = $perfil->mostrarPerfiles();
                
            ?>
            <h2>Perfiles Registrados</h2>
            <p>
                En esta sesión puedes encontrar todos los perfiles registrados
                en nuestra base de datos.
            </p>
            <span class="aviso">
                <span class="icon-notification"></span> 
                Por el momento no puedes añadir ni quitar perfiles por cuestiones de seguridad,
                para más información comunicate con los desarrolladores de la web <b>SearchJob</b>
            </span>
            <table border="1">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                </tr>
                <!-----condición para validar que exista una sesión-------->
                <?php if(isset($_SESSION['admin'])): ?>
                    <!-----condición para validar que exista un registro-------->
                    <?php if($per->num_rows >= 1 && isset($_POST)): ?>
                        <!-----ciclo para mostrar los campos-------->
                        <?php while($perfil = $per->fetch_object()): ?>
                    <tr>
                        <td><?=$perfil->codigo ?></td>
                        <td><?=$perfil->nombre ?></td>
                    </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Aún no hay perfiles registrados</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Aún no hay perfiles registrados</p>
                <?php endif; ?>
            </table>
            <a href="../admin/administrarTablas.php" class="volver">Volver</a>
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