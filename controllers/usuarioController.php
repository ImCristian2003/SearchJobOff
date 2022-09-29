<?php

    require_once "models/usuarioModel.php";

    class usuarioController{
        //Función para logearse
        public function login(){
            //Validar que exista el post
            if(isset($_POST)){
                //Verificar existencia de los datos
                $id = !empty($_POST['id']) ? $_POST['id'] : false;
                $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : false;
                //Verificar que no estén vacíos
                if(!empty($id) != false && !empty($contrasena) != false){
                    //Instancia de la clase Usuario
                    $login = new usuarioModel();
                    //Setters
                    $login->setId($id);
                    $login->setContrasena($contrasena);
                    //Función que devuelve los datos registrados
                    $log = $login->login();
                    //Si es true y es un objeto
                    if($log && is_object($log)){
                        //Redirección y sesión en caso de tener un perfíl de empleado
                        if($log->perfil == "1"){
                            $_SESSION['empleado'] = $log;
                            header("Location: views/usuario/indexUsuario.php");
                        }
                        //Redirección y sesión en caso de tener un perfíl de empresa
                        if($log->perfil == "2"){
                            $_SESSION['empresa'] = $log;
                            header("Location: views/empresa/indexEmpresa.php");
                        }
                        //Redirección y sesión en caso de tener un perfíl de administrador
                        if($log->perfil == "3"){
                            $_SESSION['admin'] = true;
                        }

                    }else{
                        //Redirección y sesión en caso de algún error
                        $_SESSION['fail'] = "Inicio de Sesión Fallido";
                        header("Location: login.php");
                    }

                }else{
                    //Redirección y sesión en caso de algún error
                    $_SESSION['fail'] = "Inicio de Sesión Fallido";
                    header("Location: login.php");
                }

            }else{
                //Redirección y sesión en caso de algún error
                $_SESSION['fail'] = "Inicio de Sesión Fallido";
                header("Location: login.php");
            }

        }
        //Función para cambiar la contraseña
        public function cambiarContrasena(){
            //Verificar que exista el metodo post y alguna sesión
            if((isset($_POST)) && isset($_SESSION['empleado']) || isset($_SESSION['empresa'])){
                //Guardar los datos suministrados
                $actual = $_POST['actual'];
                $nueva = $_POST['nueva'];
                //Verificar que no estén vacías
                if(!empty($actual) && !empty($nueva)){
                    //Verificar cual sesión existe
                    if(empty($_POST['empresa'])){
                        $id = $_POST['empleado'];
                    }else{
                        $id = $_POST['empresa'];
                    }
                    //Instancia 
                    $cambiar = new UsuarioModel();
                    //Setters de los datos necesarios para cambiar la contraseña
                    $cambiar->setId($id);
                    $cambiar->setContrasena($actual);
                    $cambiar->setNueva($nueva);
                    //Metodo que cambia la contraseña
                    $cambiada = $cambiar->cambiarContrasena();
                    //Si todo ocurre bien
                    if($cambiada){
                        //Validar la sesión existente, borrar la misma y redireccionar al login
                        //para reingreso de credenciales
                        if(isset($_SESSION['empleado'])){
                            unset($_SESSION['empleado']);
                            header("Location: login.php");
                        }else{
                            unset($_SESSION['empresa']);
                            header("Location: login.php");
                        }
                    }else{
                        //Sesión en caso de un error
                        $_SESSION['error'] = "Error";
                        //Validar sesión existente y hacer su respectivo redireccionamiento
                        if(isset($_SESSION['empleado'])){
                            header("Location: views/usuario/datosUsuario.php");
                        }else{
                            header("Location: views/empresa/datosEmpresa.php");
                        }
                        
                    }

                }else{
                    //Sesión en caso de un error
                    $_SESSION['error'] = "Error";
                    //Validar sesión existente y hacer su respectivo redireccionamiento
                    if(isset($_SESSION['empleado'])){
                        header("Location: views/usuario/datosUsuario.php");
                    }else{
                        header("Location: views/empresa/datosEmpresa.php");
                    }
                }

            }else{
                //Sesión en caso de un error
                $_SESSION['error'] = "Error";
                //Validar sesión existente y hacer su respectivo redireccionamiento
                if(isset($_SESSION['empleado'])){
                    header("Location: views/usuario/datosUsuario.php");
                }else{
                    header("Location: views/empresa/datosEmpresa.php");
                }
            }

        }

    }