<?php

    //Uso de el modelo del empleado
    require_once 'models/empleadoModel.php';

    //Clase para el controlador del empleado
    class EmpleadoController{

        //Función para guardar los datos del empleado
        public function guardarEmpleado(){

            //Validar que exista el metodo post
            if(isset($_POST)){
                
                //Se reciben todos los campos enviados para verificar que existan
                $id = isset($_POST['id']) ? (int) $_POST['id'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
                $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
                $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
                $perfil = 1;

                //ARRAY PARA MOSTRAR LOS ERRORES
                $errores = array();

                //VALIDACIÓN PARA EL ID
                if(!empty($id) && is_numeric($id) && preg_match("/[0-9]/",$id)){
                    $id_validado = true;
                }else{
                    $id_validado = false;
                    $errores['id'] = "Solo se permiten números";
                }

                //VALIDACIÓN PARA EL NOMBRE
                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
                    $nombre_validado = true;
                }else{
                    $nombre_validado = false;
                    $errores['nombre'] = "No se permiten números en este campo";
                }

                //VALIDACIÓN PARA LOS APELLIDOS
                if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
                    $apellido_validado = true;
                }else{
                    $apellido_validado = false;
                    $errores['apellido'] = "No se permiten números en este campo";
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
                    $errores['perfil'] = "Perfil no válido";
                }

                //Validar que exista el archivo que corresponderá a la hoja de vida
                if(isset($_FILES['hoja_vida'])){

                    $file = $_FILES['hoja_vida'];
                        //Guardar en una variable el nombre de la imagen
                        $filename = $file['name'];
                        //Guardar en una variable el tipo de la imagen (pdf, jpg, etc)
                        $mimetype = $file['type'];

                        //Validar que lo que llegue si sea un archivo valido
                        if($mimetype == "application/pdf" || $mimetype == "application/msword"){

                            //Si no existe un directorio donde guardar
                            //Las imagenes, con esta validacion el
                            //directorio se creará por si solo
                            if(!is_dir('uploads/hojas_de_vida')){
                                //Permisos que se concederán
                                //El true sirve para hacerle saber que es
                                //un directorio recursivo
                                mkdir('uploads/hojas_de_vida',0777,true);
                            }

                            //Funcion para poner el archivo en la carpeta con su respectivo nombre
                            move_uploaded_file($file['tmp_name'], 'uploads/hojas_de_vida/'.$filename);

                        }else{
                            //En caso de que no se suba el archivo con el formato correcto
                            $filename = "sin_hoja_vida";
                        }

                }else{
                    //En caso de que no se suba el archivo, se le asignará null
                    $filename = "sin_hoja_vida";
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

                //Validación de que no hallan errores
                if(count($errores) == 0){

                    //Instancia de la clase modelo del empleado
                    $usuario = new EmpleadoModel();
                    //Sets para cargar todos los datos correspondientes
                    $usuario->setId($id);
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellido);
                    $usuario->setTelefono($telefono);
                    $usuario->setDireccion($direccion);
                    $usuario->setCorreo($correo);
                    $usuario->setContrasena($contrasena);
                    $usuario->setPerfil($perfil);
                    $usuario->setHojaVida($filename);
                    //Función que guarda todos los datos
                    $save = $usuario->guardarEmpleado();

                    //En caso de el metodo save retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($save){
                        $_SESSION['registro'] = "Complete";
                    }else{
                    //En caso de el metodo save retorne un false, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['registro_fail'] = "Fail";
                    }

                }else if(count($errores) != 0 && !isset($_GET['modificar'])){
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                }else{
                    $val = false;
                }

                //Condición para cuando se vaya a modificar algún campo
                if(isset($_GET['modificar']) && count($errores) == 1){

                    //Instancia de la clase modelo del empleado
                    $modificar = new EmpleadoModel();
                    //Sets para cargar todos los datos correspondientes
                    $modificar->setId($id);
                    $modificar->setNombre($nombre);
                    $modificar->setApellidos($apellido);
                    $modificar->setTelefono($telefono);
                    $modificar->setDireccion($direccion);
                    $modificar->setCorreo($correo);
                    $modificar->setHojaVida($filename);
                    $modificar->setImagen($imagenname);
                    //Metodo para cargar los datos
                    $mod = $modificar->modificarEmpleado();

                    //En caso de el metodo mod retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($mod){
                        $_SESSION['modificado'] = "Complete";
                        if(isset($_SESSION['empleado'])){
                            //Se borra la sesión actual para actualizar los datos de la sesión
                            unset($_SESSION['empleado']);
                            header("Location: login.php");
                        }
                    }else{
                    //En caso de el metodo mod retorne un false, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['modificado_fail'] = "Fail";
                    }

                }else if(isset($_GET['modificar']) && count($errores) > 1){
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                }else{
                    //Esto es porque sí
                    $val = false;
                }

            }else{
                //En caso de que no exista el metodo POST, se crea una sesion
                //que indicará que hay un fallo
                $_SESSION['registro_fail'] = "Fail";
            }
            //Redireccionar al registro
            if(!isset($_GET['modificar'])){
                //En caso de que no exista el modificar
                header("Location: views/usuario/registroEmpleado.php");
            }else{
                //En caso de que si exista el modificar
                header("Location: views/usuario/datosUsuario.php");
            }

        }

        public function logout(){

            //Condicion para saber si existe la sesión
            if(isset($_SESSION['empleado'])){
                //Borrar la sesión
                unset($_SESSION['empleado']);

            }

            //Redirección al index
            header("Location: index.php");

        }

    }