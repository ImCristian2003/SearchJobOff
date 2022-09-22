<?php

    function borrarSesion($name){

        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }

    }

    function mostrarError($sesion,$campo){

        if(isset($sesion[$campo])){

            echo "<div class='alert alert-danger' style='background-color:#FF0000; color:#fff; border-radius:8px; padding:4px;'>".$sesion[$campo]."</div>";

        }

    }