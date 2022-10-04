<?php

    //Se usa el modelo de cargo
    require_once "models/cargoModel.php";
    //Se usa el modelo de empleo
    require_once "models/empleoModel.php";
    //Se usa el modelo de postulacion
    require_once "models/postulacionModel.php";

    class cargoExecuteController{

        //Guardar un municipio
        public function guardarCargo(){
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

                    $guardar = new CargoModel();
                    $guardar->setNombre($nombre);
                    $guardado = $guardar->guardarCargo();

                    if($guardado){
                        $_SESSION['complete'] = "Complete";
                        header("Location: views/cargos/registrarCargo.php");
                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/cargos/registrarCargo.php");
                    }

                }else{
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                    header("Location: views/cargos/registrarCargo.php");
                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/cargos/registrarCargo.php");
            }

        }

        //Función para mostrar los registros de la tabla municipio
        public function eliminarCargo(){
            //Comprobar que exista el admin y el codigo correspondiente del registro
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Almacenar el codigo en una variable
                $codigo = (int)$_GET['id'];

                //Eliminar todos los registros en los que aparezca el usuario (tabla postulaciones)
                $empleo = new EmpleoModel();
                $empleo->setCargo($codigo);
                $empleos = $empleo->obtenerEmpleosBorrarFKCargo();
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
                    $empleo1->setCargo($codigo);
                    $empleos1 = $empleo1->eliminarEmpleoCargo();
                    // var_dump($empleos1);
                    // die();

                    if($empleos1){

                        $eliminar = new CargoModel();
                        $eliminar->setCodigo($codigo);
                        $eliminado = $eliminar->eliminarCargo();
                        // var_dump($eliminado);
                        // die();

                        if($eliminado){
                            $_SESSION['complete'] = "Complete";
                            header("Location: views/cargos/indexCargo.php");
                        }else{
                            $_SESSION['fail'] = "Fail";
                            header("Location: views/cargos/indexCargo.php");
                        }

                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/cargos/indexCargo.php");
                    }

                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/cargos/indexCargo.php");
            }

        }

    }