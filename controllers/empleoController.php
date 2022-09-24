<?php

    //Se usa el modelo de municipio
    require_once "../../models/municipioModel.php";
    //Se usa el model del empleo
    require_once "../../models/empleoModel.php";
    require_once "../../models/municipioModel.php";
    require_once "../../models/cargoModel.php";
    require_once "../../models/sectorModel.php";
    require_once "../../models/tipoContratoModel.php";

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

        //Funciones para traer los datos de todas las claves foraneas
        public function mostrarMunicipios(){

            $municipio = new MunicipioModel();
            $municipios = $municipio->conseguirMunicipios();

            return $municipios;

        }

        public function mostrarCargos(){

            $cargo = new CargoModel();
            $cargos = $cargo->conseguirCargos();

            return $cargos;

        }

        public function mostrarSector(){

            $sector = new SectorModel();
            $sectores = $sector->conseguirSector();

            return $sectores;
            
        }

        public function mostrarTipoContrato(){

            $tipo = new TipoContratoModel();
            $tipos = $tipo->conseguirTipoContrato();

            return $tipos;
            
        }
    
    }