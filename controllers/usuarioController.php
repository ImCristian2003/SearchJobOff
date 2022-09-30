<?php

    require_once "models/usuarioModel.php";
    require_once "models/postulacionModel.php";
    require_once "models/calificacionModel.php";
    require_once "models/empleoModel.php";

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
                            $_SESSION['admin'] = $log;
                            header("Location: views/admin/indexAdmin.php");
                        }else{
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
        //Función para eliminar un usuario
        public function eliminarUsuario(){
            //Validar qye exista el admin y un id
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Capturar el id del usuario
                $id = $_GET['id'];
                //Eliminar todos los registros en los que aparezca el usuario (tabla postulacion)
                $postulacion = new PostulacionModel();
                $postulacion->setUsuario($id);
                $postulaciones = $postulacion->eliminarUsuario();
                //En caso de que se elimine correctamente
                if($postulaciones){

                    //Eliminar todos los registros en los que aparezca el usuario (tabla calificacion)
                    $calificacion = new calificacionModel();
                    $calificacion->setUsuario($id);
                    $calificaciones = $calificacion->eliminarUsuario();
                    //En caso de que se elimine correctamente
                    if($calificaciones){
                        //validar el perfil del usuario
                        if($_GET['perfil'] == "2"){

                            //Eliminar todos los registros en los que aparezca el usuario (tabla postulaciones)
                            $empleo = new EmpleoModel();
                            $empleo->setEmpresa($id);
                            $empleos = $empleo->obtenerEmpleosBorrar();
                            
                            while($emp = $empleos->fetch_object()){

                                $codigo = $emp->codigo;

                                $postulacion1 = new PostulacionModel();
                                $postulacion1->setEmpleo($codigo);
                                $postulaciones1 = $postulacion1->eliminarEmpleo();

                            }

                            if(isset($postulaciones1)){

                                $empleo = new EmpleoModel();
                                $empleo->setEmpresa($id);
                                $empleos = $empleo->obtenerEmpleosBorrar();

                                //Eliminar todos los registros en los que aparezca el usuario (tabla empleo)
                                $usuario = new UsuarioModel();

                                $usuario->setId($id);
                                $usuarios = $usuario->eliminarUsuario();
                                var_dump($usuarios);
                                die();

                                //En caso de que se elimine correctamente
                                //En caso de que funcione
                                if($usuarios){
                                    //Sesión para indicar que todo funcionó
                                    $_SESSION['complete'] = "Complete";
                                    //Redirección
                                    header("Location: views/admin/verEmpleados.php");
                                }else{
                                    //Sesión para indicar que algo no funcionó
                                    $_SESSION['fail'] = "Fail";
                                    //Redirección
                                    header("Location: views/admin/verEmpleados.php");
                                }

                            }else{
                                //Sesión para indicar que algo no funcionó
                                $_SESSION['fail'] = "Fail";
                                //Redirección
                                header("Location: views/admin/verEmpleados.php");
                            }

                        }else{
                            //Sesión para indicar que algo no funcionó
                            $_SESSION['fail'] = "Fail";
                            //Redirección
                            header("Location: views/admin/verEmpleados.php");
                        }
                        

                    }else{
                        //Sesión para indicar que algo no funcionó
                        $_SESSION['fail'] = "Fail";
                        //Redirección
                        header("Location: views/admin/verEmpleados.php");
                    }

                }else{
                    //Sesión para indicar que algo no funcionó
                    $_SESSION['fail'] = "Fail";
                    //Redirección
                    header("Location: views/admin/verEmpleados.php");
                }

            }else{
                //Sesión para indicar que algo no funcionó
                $_SESSION['fail'] = "Fail";
                //Redirección
                header("Location: views/admin/verEmpleados.php");
            }

        }

    }