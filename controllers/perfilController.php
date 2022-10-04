<?php

    //Se usa el modelo de perfil
    require_once "../../models/perfilModel.php";

    class PerfilController{

        //Función para mostrar los registros de la tabla municipio
        public function mostrarPerfiles(){

            $perfil = new PerfilModel();
            //Sacar todos los datos
            $perfiles = $perfil->mostrarPerfiles();
            //Retorno de dichos datos
            return $perfiles;

        }
    
    }