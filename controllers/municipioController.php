<?php

    //Se usa el modelo de municipio
    require_once "models/municipioModel.php";

    class municipioController{

        public function mostrarMunicipios(){

            $municipio = new MunicipioModel();
            $municipios = $municipio->conseguirMunicipios();

            return $municipios;

        }

        public function index(){
            echo "funcionando";
        }

    }