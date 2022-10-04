<?php

    //Se usa el modelo de municipio
    require_once "../../models/tipoContratoModel.php";

    class TipoContratoController{

        //Función para mostrar los registros de la tabla municipio
        public function conseguirContratos(){

            $contrato = new TipoContratoModel();
            //Sacar todos los datos
            $contratos = $contrato->conseguirTipoContrato();
            //Retorno de dichos datos
            return $contratos;

        }

    }