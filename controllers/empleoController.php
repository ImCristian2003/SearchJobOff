<?php

    //Se usa el modelo de municipio
    require_once "../../models/municipioModel.php";
    //Se usa el model del empleo
    require_once "../../models/empleoModel.php";

    class EmpleoController{

        public function mostrarEmpleos(){

            $nombre = $_POST['nombre'];
            $municipio = (int)$_POST['id'];

            $empleo = new EmpleoModel();
            $empleo->setNombre($nombre);
            $empleo->setMunicipio($municipio);
            $empleos = $empleo->obtenerEmpleos();
            
            return $empleos;

        }

        public function detalleEmpleo(){

            $codigo = $_GET['id'];
            $detalle = new EmpleoModel();
            $detalle->setCodigo($codigo);
            $detalles = $detalle->obtenerUno();
            
            return $detalles;

        }

        public function mostrarMunicipios(){

            $municipio = new MunicipioModel();
            $municipios = $municipio->conseguirMunicipios();

            return $municipios;

        }
    
    }