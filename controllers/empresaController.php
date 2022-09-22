<?php

    require_once "models/empresaModel.php";

    class empresaController{

        public function guardarEmpresa(){

            if(isset($_POST)){

                //Se reciben todos los campos enviados para verificar que existan
                $nit = isset($_POST['nit']) ? $_POST['nit'] : false;
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
                    $errores['nombre'] = "No se permiten numeros en este campo";
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
                    $errores['contrasena'] = "La contraseña no puede estár vacía";
                }

                //VALIDACIÓN PARA EL PERFIL
                if(!empty($perfil) && is_numeric($perfil) && preg_match("/[0-9]/",$perfil)){
                    $perfil_validado = true;
                }else{
                    $errores['perfil'] = "Perfil no valido";
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
            header("Location: views/empresa/registroEmpresa.php");

        }
        
    }