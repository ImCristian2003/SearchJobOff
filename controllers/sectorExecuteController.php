<?php

    //Se usa el modelo de sector
    require_once "models/sectorModel.php";
    //Se usa el modelo de empleo
    require_once "models/empleoModel.php";
    //Se usa el modelo de postulacion
    require_once "models/postulacionModel.php";

    class sectorExecuteController{

        //Guardar un municipio
        public function guardarSector(){
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
                    //Guardar el sector
                    $guardar = new SectorModel();
                    $guardar->setNombre($nombre);
                    $guardado = $guardar->guardarSector();
                    //En caso de que guarde o nó
                    if($guardado){
                        $_SESSION['complete'] = "Complete";
                        header("Location: views/sectores/registrarSector.php");
                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/sectores/registrarSector.php");
                    }

                }else{
                    //En caso de que hallan errores, se crea una sesión para
                    //imprimir todos los errores
                    $_SESSION['errores'] = $errores;
                    header("Location: views/sectores/registrarSector.php");
                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/sectores/registrarSector.php");
            }

        }

        //Función para mostrar los registros de la tabla sector
        public function eliminarSector(){
            //Comprobar que exista el admin y el codigo correspondiente del registro
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Almacenar el codigo en una variable
                $codigo = (int)$_GET['id'];

                //Eliminar todos los registros en los que aparezca el usuario (tabla sector)
                $empleo = new EmpleoModel();
                $empleo->setSector($codigo);
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
                    $empleo1->setSector($codigo);
                    $empleos1 = $empleo1->eliminarEmpleoSector();
                    // var_dump($empleos1);
                    // die();

                    if($empleos1){

                        $eliminar = new SectorModel();
                        $eliminar->setCodigo($codigo);
                        $eliminado = $eliminar->eliminarSector();
                        // var_dump($eliminado);
                        // die();

                        if($eliminado){
                            $_SESSION['complete'] = "Complete";
                            header("Location: views/sectores/indexSector.php");
                        }else{
                            $_SESSION['fail'] = "Fail";
                            header("Location: views/sectores/indexSector.php");
                        }

                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/sectores/indexSector.php");
                    }

                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/sectores/indexSector.php");
            }

        }

    }