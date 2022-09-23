<?php

    require_once "models/postulacionModel.php";

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

    }