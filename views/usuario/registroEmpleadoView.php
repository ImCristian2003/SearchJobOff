<body>

    <h1>Registrarse</h1>

    <?php   if(isset($_SESSION['register']) && $_SESSION['register'] == 'Registro completado'): ?>
                
                <strong>Registro completado correctamente</strong>
        
    <?php   elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'Registro fallido'):  ?>

                <strong>Registro fallido</strong>

    <?php   endif;  ?>
    <?php //Utils::deleteSession('register'); ?>

    <form action="" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" required>

        <input type="submit" value="Enviar">

    </form>

</body>