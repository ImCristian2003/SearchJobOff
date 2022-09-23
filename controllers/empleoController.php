<?php

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

    }