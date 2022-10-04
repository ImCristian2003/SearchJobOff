<?php

    //Se usa el modelo de municipio
    require_once "../../models/municipioModel.php";

    class municipioController{

        //Función para mostrar los registros de la tabla municipio
        public function conseguirMunicipios(){

            $municipio = new MunicipioModel();
            //Sacar todos los datos
            $municipios = $municipio->conseguirMunicipios();
            //Retorno de dichos datos
            return $municipios;

        }

    }