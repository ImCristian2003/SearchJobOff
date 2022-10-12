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
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin'])){
                //Función para contar las calificaciones
                $contar = new CalificacionModel();
                $contado = $contar->contarCalificaciones();

                return $contado;

            }

        }
        //Cantidad de calificaciones según las estrellas
        public function reporteCalificacionesEstrellas(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $calificacion = (int)$_POST['calificacion'];

                $contar = new CalificacionModel();
                $contar->setCalificacion($calificacion);
                $contado = $contar->reporteCalificacionesEstrellas();

                return $contado;

            }

        }
        //Cantidad de calificaciones según las fechas
        public function reporteCalificacionesFecha(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $fecha_inicial = $_POST['fecha_inicial'];
                $fecha_final = $_POST['fecha_final'];

                $contar = new CalificacionModel();
                $contar->setFecha($fecha_inicial);
                $contar->setFechaFinal($fecha_final);
                $contado = $contar->reporteCalificacionesFecha();

                return $contado;

            }

        }

    }