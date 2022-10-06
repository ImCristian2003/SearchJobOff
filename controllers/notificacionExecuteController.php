<?php

    require_once "models/notificacionModel.php";

    class NotificacionExecuteController{
        //Funcion para marcar como "leída" una notificacion
        public function marcarLeido(){
            //Verificar que exista el codigo por medio de GET
            if(isset($_GET)){
                //Almacenar el codigo en un variable
                $codigo = (int) $_GET['codigo'];
                //Cargar el respectivo estado (leido)
                $leido = new NotificacionModel();
                $leido->setCodigo($codigo);
                $leidos = $leido->marcarLeido();
                //Verificar que haya funcionado la consulta y hacer una redirección
                if($leidos){
                    $_SESSION['notificacion'] = "Complete";
                    header("Location: views/notificaciones/notificacionesAdmin.php");
                }else{
                    //Verificar en caso de que no haya funcionado la consulta y hacer una redirección
                    $_SESSION['notificacion_fail'] = "Fail";
                    header("Location: views/notificaciones/notificacionesAdmin.php");
                }

            }else{
                //Verificar en caso de que no exista el metodo GET
                $_SESSION['notificacion_fail'] = "Fail";
                header("Location: views/notificaciones/notificacionesAdmin.php");
            }

        }

    }