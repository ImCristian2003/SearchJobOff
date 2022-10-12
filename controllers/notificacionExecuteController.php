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
                    //Crear una sesión para indicar fallo o exito
                    $_SESSION['notificacion'] = "Complete";
                    //Validar quien está logeado para hacer la respectiva redirección
                    if(isset($_SESSION['admin'])){
                        header("Location: views/notificaciones/notificacionesAdmin.php");
                    }else if(isset($_SESSION['empresa'])){
                        header("Location: views/notificaciones/notificacionesEmpresa.php");
                    }else{
                        header("Location: views/notificaciones/notificacionesEmpleado.php");
                    }

                }else{
                    //Verificar en caso de que no haya funcionado la consulta y hacer una redirección
                    $_SESSION['notificacion_fail'] = "Fail";
                    //Validar quien está logeado para hacer la respectiva redirección
                    if(isset($_SESSION['admin'])){
                        header("Location: views/notificaciones/notificacionesAdmin.php");
                    }else if(isset($_SESSION['empresa'])){
                        header("Location: views/notificaciones/notificacionesEmpresa.php");
                    }else{
                        header("Location: views/notificaciones/notificacionesEmpleado.php");
                    }
                }

            }else{
                //Verificar en caso de que no exista el metodo GET
                $_SESSION['notificacion_fail'] = "Fail";
                //Validar quien está logeado para hacer la respectiva redirección
                if(isset($_SESSION['admin'])){
                    header("Location: views/notificaciones/notificacionesAdmin.php");
                }else if(isset($_SESSION['empresa'])){
                    header("Location: views/notificaciones/notificacionesEmpresa.php");
                }else{
                    header("Location: views/notificaciones/notificacionesEmpleado.php");
                }
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
        //Borrar una notificación
        public function eliminarNotificacion(){

            //Verificar que existe el admin y el metodo get
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Guardar el codigo
                $codigo = (int)$_GET['id'];
                //Verificar que el codigo no sea un valor vacío
                if(!empty($codigo)){
                    //Instancia y proceso para borrar la notificación
                    $notificacion = new NotificacionModel();
                    $notificacion->setCodigo($codigo);
                    $eliminado = $notificacion->eliminarNotificacion();
                    //En caso de que funcione la consulta crear una sesión y redireccionar
                    if($eliminado){
                        $_SESSION['complete'] = "Complete";
                        header("Location: views/notificaciones/administrarNotificaciones.php");
                    }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/notificaciones/administrarNotificaciones.php");
                    }

                }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                    $_SESSION['fail'] = "Fail";
                    header("Location: views/notificaciones/administrarNotificaciones.php");
                }

            }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                $_SESSION['fail'] = "Fail";
                header("Location: views/notificaciones/administrarNotificaciones.php");
            }

        }
        //Borrar un reporte
        public function eliminarReporte(){

            //Verificar que existe el admin y el metodo get
            if(isset($_SESSION['admin']) && isset($_GET['codigo'])){
                //Guardar el codigo
                $codigo = (int)$_GET['codigo'];
                //Verificar que el codigo no sea un valor vacío
                if(!empty($codigo)){
                    //Instancia y proceso para borrar la notificación
                    $notificacion = new NotificacionModel();
                    $notificacion->setUsuario($codigo);
                    $eliminado = $notificacion->eliminarReporte();
                    //En caso de que funcione la consulta crear una sesión y redireccionar
                    if($eliminado){
                        $_SESSION['complete'] = "Complete";
                        header("Location: views/empleo/administrarEmpleos.php");
                    }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/empleo/administrarEmpleos.php");
                    }

                }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                    $_SESSION['fail'] = "Fail";
                    header("Location: views/empleo/administrarEmpleos.php");
                }

            }else{//En caso de que no funcione la consulta crear una sesión y redireccionar
                $_SESSION['fail'] = "Fail";
                header("Location: views/empleo/administrarEmpleos.php");
            }

        }
    }