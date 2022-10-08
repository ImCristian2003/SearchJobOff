<?php

    require_once "../../models/calificacionModel.php";

    class CalificacionController{
        //Conseguir todas las calificaciones registradas
        public function conseguirCalificaciones(){

            $cal = new CalificacionModel();
            $calificaciones = $cal->conseguirCalificaciones();

            return $calificaciones;

        }

        //Conseguir todas las calificaciones registradas
        public function conseguirCalificacionesUsuario(){

            if(isset($_SESSION['empleado'])){

                $id = $_SESSION['empleado']->id;
                $cal = new CalificacionModel();
                $cal->setUsuario($id);
                $calificaciones = $cal->conseguirCalificacionesUsuario();

                return $calificaciones;

            }else if(isset($_SESSION['empresa'])){

                $id = $_SESSION['empresa']->id;
                $cal = new CalificacionModel();
                $cal->setUsuario($id);
                $calificaciones = $cal->conseguirCalificacionesUsuario();

                return $calificaciones;

            }else{
                header("Location: ../../index.php");
            }

        }
        //Cantidad de calificaciones registrados
        public function contarCalificaciones(){

            if(isset($_SESSION['admin'])){

                $contar = new CalificacionModel();
                $contado = $contar->contarCalificaciones();

                return $contado;

            }

        }

    }