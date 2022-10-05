<?php

    //Se usa el modelo de municipio
    require_once "../../models/municipioModel.php";
    //Se usa el model del empleo
    require_once "../../models/empleoModel.php";
    //Se usa el model del municipio
    require_once "../../models/municipioModel.php";
    //Se usa el model del cargo
    require_once "../../models/cargoModel.php";
    //Se usa el model del sector
    require_once "../../models/sectorModel.php";
    //Se usa el model del tipo de contrato
    require_once "../../models/tipoContratoModel.php";

    class EmpleoController{

        public function mostrarEmpleos(){


            if(isset($_POST)){

                //Almacenamiento de los valores correspondientes en las variables
                $nombre = $_POST['nombre'];
                $municipio = (int)$_POST['id'];

                //Instancia del modelo de empleo
                $empleo = new EmpleoModel();
                //Sets
                $empleo->setNombre($nombre);
                $empleo->setMunicipio($municipio);
                //Función que retorna todos los empleos disponibles
                $empleos = $empleo->obtenerEmpleos();
                
                //Retorno de la variable
                return $empleos;

            }

        }

        public function detalleEmpleo(){

            //Verificar que exista el metodo get
            if(isset($_GET['id'])){

                //Almacenamiento de los valores correspondientes en las variables
                $codigo = $_GET['id'];
                $detalle = new EmpleoModel();
                $detalle->setCodigo($codigo);
                //Metodo para obtener los datos de un solo empleo
                $detalles = $detalle->obtenerUno();
                //Retorno de la variable
                return $detalles;

            }else if(isset($_POST['id'])){//En caso de que el metodo que exista sea post

                //Almacenamiento de los valores correspondientes en las variables
                $codigo = $_POST['id'];
                $detalle = new EmpleoModel();
                $detalle->setCodigo($codigo);
                //Metodo para obtener los datos de un solo empleo
                $detalles = $detalle->obtenerUno();
                //Retorno de la variable
                return $detalles;

            }else{
                //Redireccion en caso de que no existe ningún metodo
                header("Location: ../../index.php");
            }

        }

        public function empleosPublicados(){

            //Verificar que la sesión existe
            if(isset($_SESSION['empresa'])){
                
                //Almacenamiento de los valores correspondientes en las variables
                $id = (int)$_SESSION['empresa']->id;
                $empleo = new EmpleoModel();
                $empleo->setEmpresa($id);
                //Metodo que trae todos los datos de los empleos publicados por una empresa
                $empleos = $empleo->empleosPublicados();
                //Retorno de la variable
                return $empleos;

            }

        }

        //Funciones para traer los datos de todas las claves foraneas
        public function mostrarMunicipios(){//Función para los municipios

            $municipio = new MunicipioModel();
            $municipios = $municipio->conseguirMunicipios();

            return $municipios;

        }

        public function mostrarCargos(){//Función para los cargos

            $cargo = new CargoModel();
            $cargos = $cargo->conseguirCargos();

            return $cargos;

        }

        public function mostrarSector(){//Función para los sectores

            $sector = new SectorModel();
            $sectores = $sector->conseguirSectores();

            return $sectores;
            
        }

        public function mostrarTipoContrato(){//Función para los tipos de contrato

            $tipo = new TipoContratoModel();
            $tipos = $tipo->conseguirTipoContrato();

            return $tipos;
            
        }
    
    }