<?php

    //Se usa el modelo de municipio
    require_once "../../models/sectorModel.php";

    class SectorController{

        //Función para mostrar los registros de la tabla municipio
        public function conseguirSectores(){

            $sector = new SectorModel();
            //Sacar todos los datos
            $sectores = $sector->conseguirSectores();
            //Retorno de dichos datos
            return $sectores;

        }

    }