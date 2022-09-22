<?php

    function borrarSesion($name){

        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }

    }

    function mostrarError($sesion,$campo){

        if(isset($sesion[$campo])){

            echo "<div class='alerta alerta-error'>".$sesion[$campo]."</div>";

        }

    }