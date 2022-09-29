<?php

    //Se usa el modelo de municipio
    require_once "models/municipioModel.php";
    //Se usa el model del empleo
    require_once "models/empleoModel.php";
    //Se usa el model de las postulaciones
    require_once "models/postulacionModel.php";

    class EmpleoExecuteController{

        public function guardarEmpleo(){
            //Verificar que exista post
            if(isset($_POST)){
                //Validar que todos los post existan sino asignarles false
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $municipio = isset($_POST['municipio']) ? (int) $_POST['municipio'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
                $cargo = isset($_POST['cargo']) ? (int) $_POST['cargo'] : false;
                $vacantes = isset($_POST['vacantes']) ? (int) $_POST['vacantes'] : false;
                $jornada = isset($_POST['jornada']) ? $_POST['jornada'] : false;
                $experiencia = isset($_POST['experiencia']) ? $_POST['experiencia'] : false;
                $sector = isset($_POST['sector']) ? (int) $_POST['sector'] : false;
                $funcion = isset($_POST['funcion']) ? $_POST['funcion'] : false;
                $empresa = isset($_POST['empresa']) ? (int) $_POST['empresa'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $salario = isset($_POST['salario']) ? (int) $_POST['salario'] : false;
                $tipo_contrato = isset($_POST['tipo_contrato']) ? (int) $_POST['tipo_contrato'] : false;
                
                //ARRAY PARA MOSTRAR LOS ERRORES
                $errores = array();

                //Validación para nombre
                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
                    $nombre_validado = true;
                }else{
                    $nombre_validado = false;
                    $errores['nombre'] = "No se permiten números en este campo";
                }

                //Validación para direccion
                if(!empty($direccion)){
                    $direccion_validado = true;
                }else{
                    $direccion_validado = false;
                    $errores['direccion'] = "Este campo no puede estar vacío";
                }

                //Validació para vacantes
                if(!empty($vacantes) && is_numeric($vacantes) && preg_match("/[0-9]/",$vacantes)){
                    $vacantes_validado = true;
                }else{
                    $vacantes_validado = false;
                    $errores['vacantes'] = "Solo se permiten números";
                }

                //Validación para jornada
                if(!empty($jornada)){
                    $jornada_validado = true;
                }else{
                    $jornada_validado = false;
                    $errores['jornada'] = "Este campo no puede estar vacío";
                }

                //Validación para experiencia
                if(!empty($experiencia)){
                    $experiencia_validado = true;
                }else{
                    $experiencia_validado = false;
                    $errores['experiencia'] = "Este campo no puede estar vacío";
                }

                //Validación para funcion
                if(!empty($funcion)){
                    $funcion_validado = true;
                }else{
                    $funcion_validado = false;
                    $errores['funcion'] = "Este campo no puede estar vacío";
                }

                //Validación para empresa
                if(!empty($empresa) && is_numeric($empresa) && preg_match("/[0-9]/",$empresa)){
                    $empresa_validado = true;
                }else{
                    $empresa_validado = false;
                    $errores['empresa'] = "Solo se permiten numeros en este campo";
                }

                //Validación para descripcion
                if(!empty($descripcion)){
                    $descripcion_validado = true;
                }else{
                    $descripcion_validado = false;
                    $errores['descripcion'] = "Este campo no puede estar vacío";
                }

                //Validación para salario
                if(!empty($salario)){
                    $salario_validado = true;
                }else{
                    $salario_validado = false;
                    $errores['salario'] = "Este campo no puede estar vacío";
                }

                //Validación para el logo de la empresa
                if(isset($_FILES['logo']) && !empty($_FILES['logo']['name'])){

                    $logo = $_FILES['logo'];
                        //Guardar en una variable el nombre de la imagen
                        $logoname = $logo['name'];
                        $logo_name_mod = $logo['name'];
                        //Guardar en una variable el tipo de la imagen (pdf, jpg, etc)
                        $mimetype = $logo['type'];

                        //Validar que lo que llegue si sea un archivo valido
                        if($mimetype == "image/jpeg" || $mimetype == "image/jpg" 
                        || $mimetype == "image/png"){

                            //Si no existe un directorio donde guardar
                            //Las imagenes, con esta validacion el
                            //directorio se creará por si solo
                            if(!is_dir('uploads/empleos_logo')){
                                //Permisos que se concederán
                                //El true sirve para hacerle saber que es
                                //un directorio recursivo
                                mkdir('uploads/empleos_logo',0777,true);
                            }

                            //Funcion para poner el archivo en la carpeta con su respectivo nombre
                            move_uploaded_file($logo['tmp_name'], 'uploads/empleos_logo/'.$logoname);

                        }else{
                            //En caso de que no se suba el archivo con el formato correcto
                            $logoname = "sin_logo";
                        }

                }else{
                    //En caso de que no se suba el archivo, se le asignará null
                    $logoname = "sin_logo";
                    $logo_name_mod = $_POST['logo_nombre'];
                }
                //En caso de que no hallan errores y no exista el metodo que indicará
                //la modificación de datos
                if(count($errores) == 0 && !isset($_GET['modificar'])){

                    //Instancia del empleo
                    $empleo = new EmpleoModel();
                    //Sets de todos los campos
                    $empleo->setNombre($nombre);
                    $empleo->setMunicipio($municipio);
                    $empleo->setDireccion($direccion);
                    $empleo->setCargo($cargo);
                    $empleo->setVacantes($vacantes);
                    $empleo->setJornada($jornada);
                    $empleo->setExperiencia($experiencia);
                    $empleo->setSector($sector);
                    $empleo->setFuncion($funcion);
                    $empleo->setEmpresa($empresa);
                    $empleo->setDescripcion($descripcion);
                    $empleo->setSalario($salario);
                    $empleo->setTipoContrato($tipo_contrato);
                    $empleo->setLogo($logoname);
                    //Ejecución del metodo para guardar los campos
                    $empleos = $empleo->guardarEmpleo();
                    
                    //En caso de el metodo empleos retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($empleos){
                        $_SESSION['registro'] = "Complete";
                        header("Location: views/empresa/registrarEmpleo.php");
                    }else{
                    //En caso de el metodo empleos retorne un false, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['registro_fail'] = "Fail";
                        header("Location: views/empresa/registrarEmpleo.php");
                    }

                }//En caso de que exista el metodo que indica que se modificarán los datos
                else if(count($errores) == 0 && isset($_GET['modificar'])){

                    //Guardar el codigo del empleo
                    $codigo = $_GET['codigo'];
                    //Instancia del empleo
                    $empleo = new EmpleoModel();
                    //Sets de todos los campos
                    $empleo->setCodigo($codigo);
                    $empleo->setNombre($nombre);
                    $empleo->setMunicipio($municipio);
                    $empleo->setDireccion($direccion);
                    $empleo->setCargo($cargo);
                    $empleo->setVacantes($vacantes);
                    $empleo->setJornada($jornada);
                    $empleo->setExperiencia($experiencia);
                    $empleo->setSector($sector);
                    $empleo->setFuncion($funcion);
                    $empleo->setEmpresa($empresa);
                    $empleo->setDescripcion($descripcion);
                    $empleo->setSalario($salario);
                    $empleo->setTipoContrato($tipo_contrato);
                    $empleo->setLogo($logo_name_mod);
                    //Ejecución del metodo para cambiar los campos
                    $empleos = $empleo->modificarEmpleo();

                    //En caso de el metodo empleos retorne un true, se crea una sesión para
                    //indicar que todo funcionó de forma correcta
                    if($empleos){
                        $_SESSION['registro'] = "Complete";
                        //Redireccion
                        header("Location: views/empresa/empleosPublicados.php");
                    }else{
                    //En caso de el metodo empleos retorne un false, se crea una sesión para
                    //indicar que algo falló
                        $_SESSION['registro_fail'] = "Fail";
                        //Redireccion
                        header("Location: views/empresa/empleosPublicados.php");
                    }

                }else{
                    //Sesión para mostrar los errores
                    $_SESSION['errores'] = $errores;
                    if(!isset($_GET['modificar'])){
                        //Redireccion en caso de que no exista 'modificar'
                        header("Location: views/empresa/registrarEmpleo.php");
                    }else{
                        //Redireccion en caso de que exista 'modificar'
                        header("Location: views/empresa/empleosPublicados.php");
                    }
                }

            }else{
                //Sesión para mostrar los errores
                $_SESSION['errores'] = $errores;
                if(!isset($_GET['modificar'])){
                    //Redireccion en caso de que no exista 'modificar'
                    header("Location: views/empresa/registrarEmpleo.php");
                }else{
                    //Redireccion en caso de que exista 'modificar'
                    header("Location: views/empresa/empleosPublicados.php");
                }
            }

        }

        public function eliminarEmpleo(){

            //Verificar que exista el get del id
            if(isset($_GET['id'])){

                //Almacenamiento del valor
                $id = $_GET['id'];
                //Instancia de la postulación
                $postulacion = new PostulacionModel();
                $postulacion->setEmpleo($id);
                //Eliminar todas las postulaciones que contengan el codigo del empleo
                $postulaciones = $postulacion->eliminarPostulacion();

                //En caso de que funcione
                if($postulaciones){

                    //Instancia del empleo
                    $empleo = new EmpleoModel();
                    $empleo->setCodigo($id);
                    //Se elimina el registro con el codigo del empleo
                    $empleos = $empleo->eliminarEmpleo();

                    //En caso de que funcione
                    if($empleos){
                        //Sesión para indicar que todo funcionó
                        $_SESSION['complete'] = "Complete";
                        //Redirección
                        header("Location: views/empresa/empleosPublicados.php");
                    }else{
                        //Sesión para indicar que algo falló
                        $_SESSION['fail'] = "Fail";
                        //Redirección
                        header("Location: views/empresa/empleosPublicados.php");
                    }

                }else{
                    //Sesión para indicar que algo falló
                    $_SESSION['fail'] = "Fail";
                    //Redirección
                    header("Location: views/empresa/empleosPublicados.php");
                }

            }else{
                //Sesión para indicar que algo falló
                $_SESSION['fail'] = "Fail";
                //Redirección
                header("Location: views/empresa/empleosPublicados.php");
            }

        }

    }