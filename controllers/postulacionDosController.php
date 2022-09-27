<?php

    require_once "../../models/postulacionModel.php";
    require_once "../../models/empleadoModel.php";

    class PostulacionDosController{

        public function obtenerPostulados(){

            if(isset($_POST['empresa'])){
                $empresa = (int)$_POST['empresa'];
                $postulado = new PostulacionModel();
                $postulado->setEmpresa($empresa);
                $postulados = $postulado->obtenerPostulados();

                return $postulados;
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