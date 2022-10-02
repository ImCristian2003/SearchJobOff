<?php

    require_once "models/calificacionModel.php";

    class CalificacionExecuteController{

        //Guardar comentario de un usuario
        public function guardarCalificacion(){

            //Validar que exista el metodo post y alguna sesión
            if((isset($_POST)) && isset($_SESSION['empleado']) || isset($_SESSION['empresa'])){

                //Validar existencia de los datos y almacenarlos en variables
                $usuario = isset($_POST['usuario']) ? (int)$_POST['usuario'] : false;
                $calificacion = isset($_POST['calificacion']) ? (int)$_POST['calificacion'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

                //Array para imprimir errores
                $errores = array();
                //Validación para usuario
                if(!empty($usuario) && is_numeric($usuario) && preg_match("/[0-9]/",$usuario)){
                    $usuario_validado = true;
                }else{
                    $usuario_validado = false;
                    $errores['usuario'] = "No se permiten letras en este campo";
                }

                //Validación para calificación
                if(!empty($calificacion) && is_numeric($calificacion) && preg_match("/[0-9]/",$calificacion)){
                    $calificacion_validado = true;
                }else{
                    $calificacion_validado = false;
                    $errores['calificacion'] = "No se permiten letras en este campo";
                }

                //Validación para descripcion
                if(!empty($descripcion)){
                    $descripcion_validado = true;
                }else{
                    $descripcion_validado = false;
                    $errores['descripcion'] = "Este campo debe contener alguna cosa";
                }
                //Si no hay ningún error
                if(count($errores) == 0){
                    //instancia de la clase
                    $guardar = new CalificacionModel();
                    //Setear los datos a guardar
                    $guardar->setUsuario($usuario);
                    $guardar->setCalificacion($calificacion);
                    $guardar->setDescripcion($descripcion);
                    //Metodo para guardar la calificación
                    $guardado = $guardar->guardarCalificacion();
                    //En caso de que funcione
                    if($guardado){
                        //Redirigir a la pagina principal de los comentarios
                        header("Location: views/calificacion/indexCalificacion.php");
                    }else{
                        //Crear sesión que indica error en la consulta
                        $_SESSION['error'] = "Error";
                        //Redireccion en caso de ser un empleado
                        if(isset($_SESSION['empleado'])){
                            header("Location: views/usuario/usuarioComentario.php");
                        }else if(isset($_SESSION['empresa'])){//Redireccion en caso de ser una empresa
                            header("Location: views/empresa/empresaComentario.php");
                        }
                    }

                }else{
                    //Crear sesión que muestra todos los errores
                    $_SESSION['errores'] = $errores;
                    //Redireccion en caso de ser un empleado
                    if(isset($_SESSION['empleado'])){
                        header("Location: views/usuario/usuarioComentario.php");
                    }else if(isset($_SESSION['empresa'])){//Redireccion en caso de ser una empresa
                        header("Location: views/empresa/empresaComentario.php");
                    }
                }

            }else{//Redirección en caso de no existir el post y alguna sesión
                header("Location: index.php");
            }

        }

        //Eliminar un comentario
        public function eliminarComentario(){
            //Verificar que llegue el codigo por get
            if(isset($_GET)){
                //almacenar los datos en variables
                $id = (int)$_GET['codigo'];
                //Verificar que no estén vacios los datos
                if(!empty($id)){
                    //Instancia de la clase
                    $borrar = new CalificacionModel();
                    //Setear el codigo
                    $borrar->setCodigo($id);
                    //Función para eliminar la calificación
                    $borrado = $borrar->eliminarCalificacion();

                    if($borrado){
                        //Sesión para indicar la correcta eliminación de un comentario
                        $_SESSION['borrado'] = "Complete";
                        //Sesión para indicar que algo falló y redireccion dependiendo el 
                        //tipo de usuario logeado
                        if(isset($_SESSION['empleado'])){
                            header("Location: views/usuario/usuarioCalificaciones.php");
                        }else if(isset($_SESSION['empresa'])){
                            header("Location: views/empresa/empresaCalificaciones.php");
                        }else{
                            header("Location: views/calificacion/indexCalificacion.php");
                        }
                    }else{
                        //Sesión para indicar la correcta eliminación de un comentario
                        $_SESSION['borrado_fail'] = "Error";
                        //Sesión para indicar que algo falló y redireccion dependiendo el 
                        //tipo de usuario logeado
                        if(isset($_SESSION['empleado'])){
                            header("Location: views/usuario/usuarioCalificaciones.php");
                        }else if(isset($_SESSION['empresa'])){
                            header("Location: views/empresa/empresaCalificaciones.php");
                        }else{
                            header("Location: views/calificacion/indexCalificacion.php");
                        }
                    }

                }else{
                    //Sesión para indicar la correcta eliminación de un comentario
                    $_SESSION['borrado_fail'] = "Error";
                    //Sesión para indicar que algo falló y redireccion dependiendo el 
                        //tipo de usuario logeado
                    if(isset($_SESSION['empleado'])){
                        header("Location: views/usuario/usuarioCalificaciones.php");
                    }else if(isset($_SESSION['empresa'])){
                        header("Location: views/empresa/empresaCalificaciones.php");
                    }else{
                        header("Location: views/calificacion/indexCalificacion.php");
                    }
                }

            }else{
                //Sesión para indicar la correcta eliminación de un comentario
                $_SESSION['borrado_fail'] = "Error";
                //Sesión para indicar que algo falló y redireccion dependiendo el 
                //tipo de usuario logeado
                if(isset($_SESSION['empleado'])){
                    header("Location: views/usuario/usuarioCalificaciones.php");
                }else if(isset($_SESSION['empresa'])){
                    header("Location: views/empresa/empresaCalificaciones.php");
                }else{
                    header("Location: views/calificacion/indexCalificacion.php");
                }
            }

        }

    }