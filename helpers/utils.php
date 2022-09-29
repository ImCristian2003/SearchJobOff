<?php
    //Función para borrar sesiones
    function borrarSesion($name){
        //Verificar la existencia de la sesión
        if(isset($_SESSION[$name])){
            //Borrar la sesión
            unset($_SESSION[$name]);
        }

    }
    //Función para mostrar errores de algún campo
    function mostrarError($sesion,$campo){
        //Validar existencia del campo y sesión correspondientes
        if(isset($sesion[$campo])){
            //Mensaje
            echo "<div class='alert alert-danger' style='background-color:#FF0000; color:#fff; border-radius:8px; padding:4px;'>".$sesion[$campo]."</div>";

        }

    }