<?php session_start(); ?>
<?php require_once "../../helpers/utils.php"; ?>
<?php require_once "../../config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Registro Empresa</title>
    <style>
        *{ /* Quitar márgenes y bordes por defecto.*/ 
            box-sizing:border-box;
            padding:0;
            margin:0;
        }

        html{ /* Codigo para que 1rem=10px*/  
            font-size:62.5%;
            font-family:'Roboto', sans-serif;
        }

        .obligatorio{
            color:red;
        }
        .container-form{
            background-image:url(../../assets/img/wave.png);
            background-repeat:no-repeat;
            background-size:cover;
            height:100vh;
            width:100%;
            position:relative;

            display:flex;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .details{
            padding: 50px;
            width: 40%;
        }
        .details h1{
            color:#fff;
            margin:2rem;
            font-size:6rem;
            position:absolute;
            right:3rem;
            top:3rem;
        }
        .details form{ 
            font-size:2rem;
            width:100%;
            margin-top:17rem;
            padding:4rem;

            display:flex;
            flex-direction:column;
            justify-content:space-between;
            gap: 3px;
        }
        form input[type='text']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:5px 0;
            padding:5px 8px;
        }
        form input[type='password']{
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 4px;
            margin:5px 0;
            padding:5px 8px;
        }
        form input[type='submit']{
            border:none;
            border-radius:8px;
            background-color:#B8B8B8;
            color:#fff;
            cursor:pointer;
            font-weight:bold;
            font-size:1.6rem;
            height:3.2rem;
            margin: 5rem 15rem;
        }
        form label{
            text-align:left;
            font-weight:700;
            font-size:1.8rem;
        }


    
    </style>
</head>
<body>
    

    <div class="container-form">
        <div class="details">
        <h1>Registro como Empresa</h1>

            <?php   if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'Complete'): ?>
                        
                        <strong>Registro completado correctamente</strong>
                
            <?php   elseif(isset($_SESSION['registro_fail']) && $_SESSION['registro_fail'] == 'Fail'):  ?>

                        <strong>Registro fallido</strong>

            <?php   endif; ?>

            <form action="../../execute.php?controller=empresa&action=guardarEmpresa" method="post">

                <label for="nit">Nit de la empresa <span class="obligatorio"> * </span></label>
                <input type="text" name="nit" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nit') : ""; ?>

                <label for="nombre">Nombre <span class="obligatorio"> * </span></label>
                <input type="text" name="nombre" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ""; ?>

                <label for="telefono">Telefono <span class="obligatorio"> * </span></label>
                <input type="text" name="telefono" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'telefono') : ""; ?>

                <label for="direccion">Direccion <span class="obligatorio"> * </span></label>
                <input type="text" name="direccion">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'direccion') : ""; ?>

                <label for="correo">Correo <span class="obligatorio"> * </span></label>
                <input type="text" name="correo" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo') : ""; ?>

                <label for="contrasena">Contraseña <span class="obligatorio"> * </span></label>
                <input type="password" name="contrasena">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'contrasena') : ""; ?>

                <label for="perfil">Perfil <span class="obligatorio"> * </span></label>
                <input type="text" name="perfil" disabled value = "2" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'perfil') : ""; ?>

                <input type="submit" value="Registrarme Ahora">

            </form>
            <?php borrarSesion('registro'); borrarSesion('registro_fail'); borrarSesion('errores'); ?>

        </div>
    </div>

</body>
</html>