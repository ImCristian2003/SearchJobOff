<?php

    //Se usa el modelo de contrato
    require_once "models/tipoContratoModel.php";
    //Se usa el modelo de empleo
    require_once "models/empleoModel.php";
    //Se usa el modelo de postulacion
    require_once "models/postulacionModel.php";

    class tipoContratoExecuteController{

        //Guardar un municipio
        public function guardarContrato(){
            //Verificar que exista el metodo post y la sesión del admin
            if(isset($_POST) && isset($_SESSION['admin'])){

                $nombre = $_POST['nombre'];

                $errores = array();

                //Validación para nombre
                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
                    $nombre_validado = true;
                }else{
                    $nombre_validado = false;
                    $errores['nombre'] = "No se permiten numeros";
                }

                //En caso de que no hayan errores
                if(count($errores) == 0){
                    //Guardar el tipo de Contrato
                    $guardar = new TipoContratoModel();
                    $guardar->setNombre($nombre);
                    $guardado = $guardar->guardarContrato();

                    if($guardado){
                        $_SESSION['complete'] = "Complete";
                        header("Location: views/contratos/registrarContrato.php");
                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/contratos/registrarContrato.php");
                    }

                }else{
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                    header("Location: views/contratos/registrarContrato.php");
                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/contratos/registrarContrato.php");
            }

        }

        //Función para mostrar los registros de la tabla tipo de contrato
        public function eliminarContrato(){
            //Comprobar que exista el admin y el codigo correspondiente del registro
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Almacenar el codigo en una variable
                $codigo = (int)$_GET['id'];

                //Eliminar todos los registros en los que aparezca el usuario (tabla postulaciones)
                $empleo = new EmpleoModel();
                $empleo->setTipoContrato($codigo);
                $empleos = $empleo->obtenerEmpleosBorrarFKContrato();
                // var_dump($empleos);
                // die();
                //conidicion para saber si hay algún empleo que haya publicado
                //el usuario
                if($empleos->num_rows >= 1){
                    //Ciclo para borrar todos los empleos
                    while($emp = $empleos->fetch_object()){

                        $codigo1 = $emp->codigo;

                        $postulacion1 = new PostulacionModel();
                        $postulacion1->setEmpleo($codigo1);
                        $postulaciones1 = $postulacion1->eliminarEmpleo();

                    }

                }else{//En caso de no haber registros
                    $postulaciones1 = "Sin postulaciones";
                }
                // var_dump($postulaciones1);
                // die();
                
                if(isset($postulaciones1)){

                    $empleo1 = new EmpleoModel();
                    $empleo1->setTipoContrato($codigo);
                    $empleos1 = $empleo1->eliminarEmpleoContrato();
                    // var_dump($empleos1);
                    // die();

                    if($empleos1){

                        $eliminar = new TipoContratoModel();
                        $eliminar->setCodigo($codigo);
                        $eliminado = $eliminar->eliminarContrato();
                        // var_dump($eliminado);
                        // die();

                        if($eliminado){
                            $_SESSION['complete'] = "Complete";
                            header("Location: views/contratos/indexContrato.php");
                        }else{
                            $_SESSION['fail'] = "Fail";
                            header("Location: views/contratos/indexContrato.php");
                        }

                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/contratos/indexContrato.php");
                    }

                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/contratos/indexContrato.php");
            }

        }

    }