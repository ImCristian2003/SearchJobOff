<?php

    require_once "../../models/postulacionModel.php";
    require_once "../../models/empleadoModel.php";

    class PostulacionDosController{

        public function obtenerPostulados(){

            if(isset($_SESSION['empresa'])){

                $empresa = (int)$_SESSION['empresa']->id;
                $postulado = new PostulacionModel();
                $postulado->setEmpresa($empresa);
                $postulados = $postulado->obtenerPostulados();

                return $postulados;

            }

        }

        public function obtenerPostulaciones(){

            if(isset($_SESSION['empleado'])){
                $empleado = (int)$_SESSION['empleado']->id;
                $postulacion = new PostulacionModel();
                $postulacion->setUsuario($empleado);
                $postulaciones = $postulacion->obtenerPostulaciones();

                return $postulaciones;
            }

        }

        public function detallesUsuario(){

            if(isset($_POST['id'])){
    
                $id = (int)$_POST['id'];
                $detalle = new EmpleadoModel();
                $detalle->setId($id);
                $detalles = $detalle->detallesEmpleado();
                
                return $detalles;
            }

        }

    }