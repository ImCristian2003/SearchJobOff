<?php

    require_once "../../models/notificacionModel.php";

    class NotificacionController{
        //Conseguir todas las notificaciones registradas
        public function conseguirNotificaciones(){

            $cal = new notificacionModel();
            $notificaciones = $cal->conseguirNotificaciones();

            return $notificaciones;

        }
        //Conseguir las notificaciones de un usuario
        public function conseguirNotificacionesUsuario(){
            //Validar que exista alguna sesión
            if(isset($_SESSION['empleado']) || isset($_SESSION['empresa']) || isset($_SESSION['admin'])){
                //Validar que sesión exista para pasarle el codigo del usuario
                if(isset($_SESSION['admin'])){
                    $usuario = $_SESSION['admin']->id;
                }else if(isset($_SESSION['empleado'])){
                    $usuario = $_SESSION['empleado']->id;
                }else{
                    $usuario = $_SESSION['empresa']->id;
                }
                //Validar que la variable que tiene el id del usuario no esté vacía
                if(!empty($usuario)){
                    //Sacar las notificaciones del usuario
                    $not = new notificacionModel();
                    $not->setUsuario($usuario);
                    $notificaciones = $not->conseguirNotificacionesUsuario();

                    return $notificaciones;

                }

            }

        }
        //Validar los empleos ya reportados
        public function validarReporte($empresa){

            if(isset($_SESSION['admin'])){

                //Sacar las notificaciones del usuario
                $reporte = new notificacionModel();
                $reporte->setUsuario($empresa);
                $reportes = $reporte->validarReporte();

                return $reportes;

            }

        }
        //Cantidad de notificaciones según el estado
        public function reporteNotificacionesEstado(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $estado = $_POST['notificacion'];

                $contar = new NotificacionModel();
                $contar->setEstado($estado);
                $contado = $contar->reporteNotificacionesEstado();

                return $contado;

            }

        }
        //Cantidad de notificaciones según las fechas
        public function reporteNotificacionesFecha(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $fecha_inicial = $_POST['fecha_inicial'];
                $fecha_final = $_POST['fecha_final'];

                $contar = new NotificacionModel();
                $contar->setFecha($fecha_inicial);
                $contar->setFechaFinal($fecha_final);
                $contado = $contar->reporteNotificacionesFecha();

                return $contado;

            }

        }
    }