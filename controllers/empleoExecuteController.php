<?php

    //Se usa el modelo de municipio
    require_once "models/municipioModel.php";
    //Se usa el model del empleo
    require_once "models/empleoModel.php";

    class EmpleoExecuteController{

        public function guardarEmpleo(){

            if(isset($_POST)){

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
                    $errores['direccion'] = "No se permiten números en este campo";
                }

                //Validació para vacantes
                if(!empty($vacantes) && is_numeric($vacantes) && preg_match("/[0-9]/",$vacantes)){
                    $vacantes_validado = true;
                }else{
                    $vacantes_validado = false;
                    $errores['vacantes'] = "Solo se permiten números";
                }

                //Validación para jornada
                if(!empty($jornada) && !is_numeric($jornada) && !preg_match("/[0-9]/",$jornada)){
                    $jornada_validado = true;
                }else{
                    $jornada_validado = false;
                    $errores['jornada'] = "No se permiten números en este campo";
                }

                //Validación para experiencia
                if(!empty($experiencia) && !is_numeric($experiencia) && !preg_match("/[0-9]/",$experiencia)){
                    $experiencia_validado = true;
                }else{
                    $experiencia_validado = false;
                    $errores['experiencia'] = "No se permiten números en este campo";
                }

                //Validación para funcion
                if(!empty($funcion) && !is_numeric($funcion) && !preg_match("/[0-9]/",$funcion)){
                    $funcion_validado = true;
                }else{
                    $funcion_validado = false;
                    $errores['funcion'] = "No se permiten números en este campo";
                }

                //Validación para empresa
                if(!empty($empresa) && is_numeric($empresa) && preg_match("/[0-9]/",$empresa)){
                    $empresa_validado = true;
                }else{
                    $empresa_validado = false;
                    $errores['empresa'] = "Solo se permiten numeros en este campo";
                }

                //Validación para descripcion
                if(!empty($descripcion) && !is_numeric($descripcion) && !preg_match("/[0-9]/",$descripcion)){
                    $descripcion_validado = true;
                }else{
                    $descripcion_validado = false;
                    $errores['descripcion'] = "No se permiten números en este campo";
                }

                //Validación para salario
                if(!empty($salario) && is_numeric($salario) && preg_match("/[0-9]/",$salario)){
                    $salario_validado = true;
                }else{
                    $salario_validado = false;
                    $errores['salario'] = "Solo se permiten numeros en este campo";
                }

                //Validación para el logo de la empresa
                if(isset($_FILES['logo'])){

                    $logo = $_FILES['logo'];
                        //Guardar en una variable el nombre de la imagen
                        $logoname = $logo['name'];
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
                }
                
                if(count($errores) == 0){

                    $empleo = new EmpleoModel();
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
                    $empleos = $empleo->guardarEmpleo();
                    var_dump($empleos);

                }

            }

        }

    }