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
        //Función para guardar una notificaci´n
        public function guardarNotificacion(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){
                //Llenar las variables con campos que llegan del formulario
                $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : false;
                $cuerpo = isset($_POST['cuerpo']) ? $_POST['cuerpo'] : false;
                //Verificar que no estén vacias las variables
                if(!empty($asunto) && !empty($asunto)){
                    //Sacar los datos necesarios para insertar
                    $empresa = $_POST['empresa'];
                    $codigo_emp = $_POST['codigo_emp'];
                    $nombre_emp = $_POST['nombre_emp'];
                    //Instancia y proceso para guardar la notificación
                    $notificacion = new NotificacionModel();
                    $notificacion->setUsuario($empresa);
                    $notificacion->setAsunto($asunto);
                    $notificacion->setCuerpo($cuerpo);
                    $guardar = $notificacion->guardarNotificacion();
                    //En caso de que funcione la consulta crear una sesión y redireccionar
                    if($guardar){
                        $_SESSION['reporte'] = "Complete";
                        header("Location: views/empleo/administrarEmpleos.php");
                    }else{ //En caso de que no funcione la consulta crear una sesión y redireccionar
                        $_SESSION['reporte_fail'] = "Fail";
                        header("Location: views/empleo/administrarEmpleos.php");
                    }

                }else{ //En caso de que no funcione la consulta crear una sesión y redireccionar
                    $_SESSION['reporte_fail'] = "Fail";
                    header("Location: views/empleo/administrarEmpleos.php");
                }

            }else{ //En caso de que no funcione la consulta crear una sesión y redireccionar
                $_SESSION['reporte_fail'] = "Fail";
                header("Location: views/empleo/administrarEmpleos.php");
            }

        }

    }