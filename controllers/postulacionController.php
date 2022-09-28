<?php

    require_once "models/postulacionModel.php";
    require_once "models/empleoModel.php";

    class PostulacionController{

        public function guardarPostulacion(){

            if(isset($_POST)){
                
                $usuario = isset($_POST['usuario']) ? (int)$_POST['usuario'] : false;
                $empleo = isset($_POST['empleo']) ? $_POST['empleo'] : false;

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

                if(count($errores) == 0){

                    $post = new PostulacionModel();
                    $post->setUsuario($usuario);
                    $post->setEmpleo($empleo);
                    $postulacion = $post->guardarPostulacion();
                    var_dump($postulacion);

                }

            }

        }

        public function eliminarPostulacion(){

            if(isset($_GET['usuario']) && isset($_GET['empleo'])){

                $usuario = (int)$_GET['usuario'];
                $empleo = (int)$_GET['empleo'];
                $eliminar = new PostulacionModel();
                $eliminar->setUsuario($usuario);
                $eliminar->setEmpleo($empleo);
                $eliminado = $eliminar->eliminarPostulacionUsuario();

                if($eliminado){
                    $_SESSION['complete'] = "Complete";
                    header("Location: views/usuario/usuarioPostulaciones.php");
                }else{
                    $_SESSION['fail'] = "Fail";
                    header("Location: views/usuario/usuarioPostulaciones.php");
                }

            }else{
                header("Location: views/usuario/usuarioPostulaciones.php");
            }
            

        }

        public function cambiarEstado(){

            if(isset($_POST)){

                $estado = $_POST['estado'];
                $codigo = (int) $_POST['codigo'];

                if(!empty($estado) && !empty($codigo)){

                    if($estado == "rechazado"){

                        $postulacion = new PostulacionModel();
                        $postulacion->setCodigo($codigo);
                        $postulaciones = $postulacion->eliminarPostulacionEstado();

                        if($postulaciones){
                            $_SESSION['rechazado'] = "Complete";
                            header("Location: views/empresa/postulados.php");
                        }else{
                            $_SESSION['rechazado'] = "Fail";
                            header("Location: views/empresa/postulados.php");
                        }

                    }else if($estado == "aprobado"){

                        $postulacion = new PostulacionModel();
                        $postulacion->setCodigo($codigo);
                        $postulacion->setEstado($estado);
                        $postulaciones = $postulacion->cambiarEstado();

                        if($postulaciones){

                            $vacantes = (int) $_POST['vacantes'];
                            $empleo = $_POST['empleo'];

                            $vacantes = $vacantes - 1;

                            $empleo1 = new EmpleoModel();
                            $empleo1->setCodigo($empleo);
                            $empleo1->setVacantes($vacantes);
                            $empleos = $empleo1->restarVacante();

                            if($empleos){
                                $_SESSION['aprobado'] = "Complete";
                                header("Location: views/empresa/postulados.php");
                            }else{
                                $_SESSION['aprobado'] = "Fail";
                                header("Location: views/empresa/postulados.php");
                            }

                        }

                    }else{
                        $_SESSION['error'] = "Error";
                        header("Location: views/empresa/postulados.php");
                    }

                }else{
                    $_SESSION['error'] = "Error";
                    header("Location: views/empresa/postulados.php");
                }

            }else{
                $_SESSION['error'] = "Error";
                header("Location: views/empresa/postulados.php");
            }

        }

    }