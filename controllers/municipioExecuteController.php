<?php

    //Se usa el modelo de municipio
    require_once "models/municipioModel.php";
    //Se usa el modelo de empleo
    require_once "models/empleoModel.php";

    class municipioExecuteController{

        //Función para mostrar los registros de la tabla municipio
        public function mostrarMunicipios(){

            $municipio = new MunicipioModel();
            //Sacar todos los datos
            $municipios = $municipio->conseguirMunicipios();
            //Retorno de dichos datos
            return $municipios;

        }

        //Función para mostrar los registros de la tabla municipio
        public function eliminarMunicipio(){
            //Comprobar que exista el admin y el codigo correspondiente del registro
            if(isset($_SESSION['admin']) && isset($_GET['id'])){
                //Almacenar el codigo en una variable
                $codigo = (int)$_GET['id'];

                //Eliminar todos los registros en los que aparezca el usuario (tabla postulaciones)
                $empleo = new EmpleoModel();
                $empleo->setMunicipio($codigo);
                $empleos = $empleo->obtenerEmpleosBorrarFK();
                //conidicion para saber si hay algún empleo que haya publicado
                //el usuario
                if($empleos->num_rows >= 1){
                    //Ciclo para borrar todos los empleos
                    while($emp = $empleos->fetch_object()){

                        $codigo = $emp->codigo;

                        $postulacion1 = new PostulacionModel();
                        $postulacion1->setEmpleo($codigo);
                        $postulaciones1 = $postulacion1->eliminarEmpleo();

                    }
                }else{//En caso de no haber registros
                    $postulaciones1 = "Sin postulaciones";
                }
                
                if(isset(postulaciones1)){

                    $empleo = new EmpleoModel();
                    $empleo->setMunicipio($codigo);
                    $empleos = $empleo->eliminarEmpleoMunicipio();

                    if($empleos){

                        $eliminar = new MunicipioModel();
                        $eliminar->setCodigo($codigo);
                        $eliminado = $eliminar->eliminarMunicipio();

                        if($eliminado){
                            $_SESSION['complete'] = "Complete";
                            header("Location: views/municipios/indexMunicipio.php");
                        }else{
                            $_SESSION['fail'] = "Fail";
                            header("Location: views/municipios/indexMunicipio.php");
                        }

                    }else{
                        $_SESSION['fail'] = "Fail";
                        header("Location: views/municipios/indexMunicipio.php");
                    }

                }

            }else{
                $_SESSION['fail'] = "Fail";
                header("Location: views/municipios/indexMunicipio.php");
            }

        }

    }