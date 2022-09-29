<?php

    require_once "models/empresaModel.php";

    class empresaController{

        //Función para registrar una empresa y tambien modificar sus datos
        public function guardarEmpresa(){

            if(isset($_POST)){

                //Se reciben todos los campos enviados para verificar que existan
                $nit = isset($_POST['nit']) ? (int) $_POST['nit'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
                $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
                $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
                $perfil = 2;

                //VARIABLE DE ERRORES
                $errores = array();

                //VALIDACIÓN PARA EL NIT
                if(!empty($nit) && is_numeric($nit) && preg_match("/[0-9]/",$nit)){
                    $nit_validado = true;
                }else{
                    $nit_validado = false;
                    $errores['nit'] = "Solo se permiten numeros";
                }

                //VALIDACIÓN PARA EL NOMBRE
                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
                    $nombre_validado = true;
                }else{
                    $nombre_validado = false;
                    $errores['nombre'] = "No se permiten números en este campo";
                }

                //VALIDACIÓN PARA EL TELEFONO
                if(!empty($telefono) && is_numeric($telefono) && preg_match("/[0-9]/",$telefono)){
                    $telefono_validado = true;
                }else{
                    $telefono_validado = false;
                    $errores['telefono'] = "Solo se permiten números";
                }

                //VALIDACIÓN PARA LA DIRECCIÓN
                if(!empty($direccion)){
                    $direccion_validado = true;
                }else{
                    $errores['direccion'] = "La dirección está vacía";
                }

                //VALIDACIÓN PARA EL CORREO
                if(!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $correo_validado = true;
                }else{
                    $errores['correo'] = "Formato de correo inválido";
                }

                //VALIDACIÓN PARA LA CONTRASEÑA
                if(!empty($contrasena)){
                    $contrasena_validado = true;
                }else{
                    $errores['contrasena'] = "La contraseña no puede estar vacía";
                }

                //VALIDACIÓN PARA EL PERFIL
                if(!empty($perfil) && is_numeric($perfil) && preg_match("/[0-9]/",$perfil)){
                    $perfil_validado = true;
                }else{
                    $errores['perfil'] = "Perfíl no válido";
                }

                //En caso de que el usuario suba una imagen para su perfil
                if(isset($_FILES['imagen'])){

                    $imagen = $_FILES['imagen'];
                    //Guardar en una variable el nombre de la imagen
                    $imagenname = $imagen['name'];
                    //Guardar en una variable el tipo de la imagen (pdf, jpg, etc)
                    $mimetype = $imagen['type'];

                        //Validar que lo que llegue si sea un archivo valido
                        if($mimetype == "image/jpeg" || $mimetype == "image/jpg" 
                        || $mimetype == "image/png"){

                            //Si no existe un directorio donde guardar
                            //Las imagenes, con esta validacion el
                            //directorio se creará por si solo
                            if(!is_dir('uploads/usuarios_perfil')){
                                //Permisos que se concederán
                                //El true sirve para hacerle saber que es
                                //un directorio recursivo
                                mkdir('uploads/usuarios_perfil',0777,true);
                            }

                            //Funcion para poner el archivo en la carpeta con su respectivo nombre
                            move_uploaded_file($imagen['tmp_name'], 'uploads/usuarios_perfil/'.$imagenname);

                        }else{
                            //En caso de que no se suba el archivo con el formato correcto
                            $imagenname = "sin_perfil";
                        }

                }else{
                    //En caso de que no se suba el archivo, se le asignará null
                    $imagenname = "sin_perfil";
                }

                if(count($errores) == 0){

                    //Instancia de la clase modelo de la empresa
                    $empresa = new EmpresaModel();
                    //Sets para cargar todos los datos correspondientes
                    $empresa->setNit($nit);
                    $empresa->setNombre($nombre);
                    $empresa->setTelefono($telefono);
                    $empresa->setDireccion($direccion);
                    $empresa->setCorreo($correo);
                    $empresa->setContrasena($contrasena);
                    $empresa->setPerfil($perfil);
                    //Función que guarda todos los datos
                    $save = $empresa->guardarEmpresa();

                    //En caso de el metodo save retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($save){
                        $_SESSION['registro'] = "Complete";
                        //Redireccionar al registro
                        header("Location: views/empresa/registroEmpresa.php");
                    }else{
                    //En caso de el metodo save retorne un flase, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['registro_fail'] = "Fail";
                        //Redireccionar al registro
                        header("Location: views/empresa/registroEmpresa.php");
                    }

                }else if(count($errores) != 0 && !isset($_GET['modificar'])){
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                    //Redireccionar al registro
                    header("Location: views/empresa/registroEmpresa.php");
                }else{
                    $val = false;
                }

                //Condición para cuando se vaya a modificar algún campo
                if(isset($_GET['modificar']) && count($errores) == 1){

                    //Instancia de la clase modelo del empleado
                    $modificar = new EmpresaModel();
                    //Sets para cargar todos los datos correspondientes
                    $modificar->setNit($nit);
                    $modificar->setNombre($nombre);
                    $modificar->setTelefono($telefono);
                    $modificar->setDireccion($direccion);
                    $modificar->setCorreo($correo);
                    $modificar->setImagen($imagenname);
                    //Metodo para cargar los datos
                    $mod = $modificar->modificarEmpresa();

                    //En caso de el metodo mod retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($mod){
                        $_SESSION['modificado'] = "Complete";
                        if(isset($_SESSION['empresa'])){
                            unset($_SESSION['empresa']);
                            header("Location: login.php");
                        }
                    }else{
                    //En caso de el metodo mod retorne un false, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['modificado_fail'] = "Fail";
                        header("Location: views/empresa/datosEmpresa.php");
                    }

                }//En caso de que el tratar de modificar halla un error que no permita
                //dicha acción
                else if(isset($_GET['modificar']) && count($errores) > 1){
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                    header("Location: views/empresa/datosEmpresa.php");
                }else{
                    $val = false;
                    header("Location: views/empresa/datosEmpresa.php");
                }

            }else{
                //En caso de que no exista el metodo POST, se crea una sesion
                //que indicará que hay un fallo
                $_SESSION['registro_fail'] = "Fail";
                //Redireccionar al registro
                if(!isset($_GET['modificar'])){
                    //En caso de que no exista el metodo modificar
                    header("Location: views/empresa/registroEmpresa.php");
                }else{
                    //En caso de que exista el metodo modificar
                    header("Location: views/empresa/datosEmpresa.php");
                }
            }

        }
        //Función para Cerrar Sesión
        public function logout(){
            //Verificar que exista la sesión empresa
            if(isset($_SESSION['empresa'])){
                //Borrar la sesión
                unset($_SESSION['empresa']);

            }
            //Redirección al index
            header("Location: index.php");

        }
        
    }