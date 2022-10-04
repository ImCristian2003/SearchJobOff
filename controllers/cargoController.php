<?php

    //Se usa el modelo de municipio
    require_once "../../models/cargoModel.php";

    class CargoController{

        //Función para mostrar los registros de la tabla municipio
        public function conseguirCargos(){

            $cargo = new CargoModel();
            //Sacar todos los datos
            $cargos = $cargo->conseguirCargos();
            //Retorno de dichos datos
            return $cargos;

        }

    }