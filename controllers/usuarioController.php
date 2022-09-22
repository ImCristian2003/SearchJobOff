<?php

    require_once "models/usuarioModel.php";

    class usuarioController{

        public function login(){

            $login = new usuarioModel();
            $login->setId($_POST['id']);
            $login->setContrasena($_POST['contrasena']);
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
                }else{
                    $_SESSION['fail'] = "Inicio de Sesión Fallido";
                }

            }

        }

    }