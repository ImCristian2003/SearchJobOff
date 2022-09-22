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
                $id = isset($_POST['id']) ? $_POST['id'] : false;
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
                    $errores['id'] = "Solo se permiten numeros";
                }

                //VALIDACIÓN PARA EL NOMBRE
                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
                    $nombre_validado = true;
                }else{
                    $nombre_validado = false;
                    $errores['nombre'] = "No se permiten numeros en este campo";
                }

                //VALIDACIÓN PARA LOS APELLIDOS
                if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
                    $apellido_validado = true;
                }else{
                    $apellido_validado = false;
                    $errores['apellido'] = "No se permiten numeros en este campo";
                }

                //VALIDACIÓN PARA EL TELEFONO
                if(!empty($telefono) && is_numeric($telefono) && preg_match("/[0-9]/",$telefono)){
                    $telefono_validado = true;
                }else{
                    $telefono_validado = false;
                    $errores['telefono'] = "Solo se permiten numeros";
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
                    $errores['correo'] = "Formato de correo invalido";
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
                    $errores['perfil'] = "Perfil no valido";
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
                    //En caso de el metodo save retorne un flase, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['registro_fail'] = "Fail";
                    }

                }else{
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                }

            }else{
                //En caso de que no exista el metodo POST, se crea una sesion
                //que indicará que hay un fallo
                $_SESSION['registro_fail'] = "Fail";
            }
            //Redireccionar al registro
            header("Location: views/usuario/registroEmpleado.php");

        }

    }