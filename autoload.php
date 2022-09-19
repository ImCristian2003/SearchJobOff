<?php

    //Función para autocargar
    function controllers_autoload($class_name){

        //Include
        include 'controllers/' . $class_name . '.php';

    }

    //Función que autocarga las clases
    spl_autoload_register('controllers_autoload');