<?php

    require_once "models/postulacionModel.php";
    require_once "models/empleoModel.php";

    class PostulacionController{

        //Función para guardar una postulación
        public function guardarPostulacion(){

            if(isset($_POST)){
                
                //Verificar que los datos existan   
                $usuario = isset($_POST['usuario']) ? (int)$_POST['usuario'] : false;
                $empleo = isset($_POST['empleo']) ? $_POST['empleo'] : false;

                //Array para mostrar los errores
                $errores = array();

                //VALIDACIÓN PARA EL USUARIO
                if(!empty($usuario) && is_numeric($usuario) && preg_match("/[0-9]/",$usuario)){
                    $usuario_validado = true;
                }else{
                    $usuario_validado = false;
                    $errores['usuario'] = "Solo se permiten números";
                }

                //VALIDACIÓN PARA EL EMPLEO
                if(!empty($empleo) && is_numeric($empleo) && preg_match("/[0-9]/",$empleo)){
                    $empleo_validado = true;
                }else{
                    $empleo_validado = false;
                    $errores['empleo'] = "Solo se permiten números";
                }
                //En caso de no haber errores
                if(count($errores) == 0){

                    //Instancia de la clase
                    $post = new PostulacionModel();
                    $post->setUsuario($usuario);
                    $post->setEmpleo($empleo);
                    //Metodo para guardar la postulación
                    $postulacion = $post->guardarPostulacion();
                    
                    //Redireccion en caso de que se postule bien
                    if($postulacion){
                        header("Location: views/usuario/usuarioPostulaciones.php");
                    }

                }else{
                    //Redireccion a las postulaciones
                    header("Location: views/usuario/usuarioPostulaciones.php");
                }

            }else{
                //Redireccion a las postulaciones
                header("Location: views/usuario/usuarioPostulaciones.php");
            }

        }

        //Función para eliminar las postulaciones hechas
        public function eliminarPostulacion(){
            //Verificar que existan los metodos que indicar el codigo del usuario y el empleo
            if(isset($_GET['usuario']) && isset($_GET['empleo'])){
                //Almacenar los datos en variables
                $usuario = (int)$_GET['usuario'];
                $empleo = (int)$_GET['empleo'];
                $eliminar = new PostulacionModel();
                $eliminar->setUsuario($usuario);
                $eliminar->setEmpleo($empleo);
                //Eliminar la postulación
                $eliminado = $eliminar->eliminarPostulacionUsuario();
                //En caso de que funcione
                if($eliminado){
                    //Sesión para indicar que todo funcionó
                    $_SESSION['complete'] = "Complete";
                    //Redirección
                    header("Location: views/usuario/usuarioPostulaciones.php");
                }else{
                    //Sesión para indicar que algo no funcionó
                    $_SESSION['fail'] = "Fail";
                    //Redirección
                    header("Location: views/usuario/usuarioPostulaciones.php");
                }

            }else{
                //Sesión para indicar que algo no funcionó
                header("Location: views/usuario/usuarioPostulaciones.php");
            }
            

        }

        //Función para cambiar el estado de una postulación
        public function cambiarEstado(){

            if(isset($_POST)){

                //Guardar los datos del estado y codigo de la postulación
                $estado = $_POST['estado'];
                $codigo = (int) $_POST['codigo'];

                //Si ninguno está vacío
                if(!empty($estado) && !empty($codigo)){

                    //En caso de que el estado sea rechazado
                    if($estado == "rechazado"){
                        //Instancia de la postulación
                        $postulacion = new PostulacionModel();
                        $postulacion->setCodigo($codigo);
                        //Se elimina la postulación de la tabla 
                        $postulaciones = $postulacion->eliminarPostulacionEstado();
                        //Si se elimina de forma correcta
                        if($postulaciones){
                            //Sesión de rechazado
                            $_SESSION['rechazado'] = "Complete";
                            //Redirección
                            header("Location: views/empresa/postulados.php");
                        }else{
                            //Sesión de que algo falló
                            $_SESSION['rechazado'] = "Fail";
                            //Redirección
                            header("Location: views/empresa/postulados.php");
                        }

                    }//En caso de que el estado sea aprobado
                    else if($estado == "aprobado"){
                        //Instancia de la postulación
                        $postulacion = new PostulacionModel();
                        $postulacion->setCodigo($codigo);
                        $postulacion->setEstado($estado);
                        //Metodo para cambiar el estado
                        $postulaciones = $postulacion->cambiarEstado();
                        //En caso de que cambie de forma exitosa
                        if($postulaciones){
                            //Almacenar las vacantes que tiene el empleo
                            $vacantes = (int) $_POST['vacantes'];
                            //Codigo del empleo
                            $empleo = $_POST['empleo'];
                            //Se resta una vacante al total
                            $vacantes = $vacantes - 1;
                            //Instancia del empleo
                            $empleo1 = new EmpleoModel();
                            $empleo1->setCodigo($empleo);
                            $empleo1->setVacantes($vacantes);
                            //Función que asigna el nuevo valor (Total-1)
                            $empleos = $empleo1->restarVacante();
                            //Si se cambia de manera exitosa
                            if($empleos){
                                //Sesión de aprobado
                                $_SESSION['aprobado'] = "Complete";
                                //Redirección
                                header("Location: views/empresa/postulados.php");
                            }else{
                                //Sesión de fallo
                                $_SESSION['aprobado'] = "Fail";
                                //Redirección
                                header("Location: views/empresa/postulados.php");
                            }

                        }

                    }else{
                        //Sesión de fallo
                        $_SESSION['error'] = "Error";
                        //Redirección
                        header("Location: views/empresa/postulados.php");
                    }

                }else{
                    //Sesión de fallo
                    $_SESSION['error'] = "Error";
                    //Redirección
                    header("Location: views/empresa/postulados.php");
                }

            }else{
                //Sesión de fallo
                $_SESSION['error'] = "Error";
                //Redirección
                header("Location: views/empresa/postulados.php");
            }

        }

    }