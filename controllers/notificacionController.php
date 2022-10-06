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
    }