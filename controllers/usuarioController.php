<?php

    require_once "models/usuarioModel.php";

    class usuarioController{

        public function login(){

            if(isset($_POST)){

                $id = !empty($_POST['id']) ? $_POST['id'] : false;
                $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : false;

                if(!empty($id) != false && !empty($contrasena) != false){

                    $login = new usuarioModel();
                    $login->setId($id);
                    $login->setContrasena($contrasena);
                    $log = $login->login();

                    if($log && is_object($log)){

                        if($log->perfil == "1"){
                            $_SESSION['empleado'] = $log;
                            header("Location: views/usuario/indexUsuario.php");
                        }

                        if($log->perfil == "2"){
                            $_SESSION['empresa'] = $log;
                            header("Location: views/empresa/indexEmpresa.php");
                        }

                        if($log->perfil == "3"){
                            $_SESSION['admin'] = true;
                        }

                    }

                }else{
                    $_SESSION['fail'] = "Inicio de Sesión Fallido";
                    header("Location: login.php");
                }

            }else{
                $_SESSION['fail'] = "Inicio de Sesión Fallido";
                header("Location: login.php");
            }

        }

    }