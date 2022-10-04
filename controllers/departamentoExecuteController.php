<?php

    //Se usa el modelo de departamento
    require_once "models/departamentoModel.php";
    //Se usa el modelo de municipio
    require_once "models/municipioModel.php";
    //Se usa el modelo de empleo
    require_once "models/empleoModel.php";
    //Se usa el modelo de postulacion
    require_once "models/postulacionModel.php";

    class municipioExecuteController{

        //Función para mostrar los registros de la tabla municipio
        public function mostrarDepartamentos(){

            $municipio = new MunicipioModel();
            //Sacar todos los datos
            $municipios = $municipio->mostrarMunicipios();
            //Retorno de dichos datos
            return $municipios;

        }
    
    }