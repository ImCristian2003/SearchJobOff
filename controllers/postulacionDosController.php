<?php

    require_once "../../models/postulacionModel.php";
    require_once "../../models/empleadoModel.php";

    class PostulacionDosController{

        //Función para obtener los postulados al empleo de una empresa
        public function obtenerPostulados(){
            //Verificar que exista la sesión
            if(isset($_SESSION['empresa'])){
                //Almacenamiento del id de la empresa
                $empresa = (int)$_SESSION['empresa']->id;
                $postulado = new PostulacionModel();
                $postulado->setEmpresa($empresa);
                //Obtener los postulados
                $postulados = $postulado->obtenerPostulados();
                //Retorno
                return $postulados;

            }

        }
        //Obtener postulaciones de un empleado
        public function obtenerPostulaciones(){
            //Verificar existencia de la sesión
            if(isset($_SESSION['empleado'])){
                //Almacenamiento del id
                $empleado = (int)$_SESSION['empleado']->id;
                $postulacion = new PostulacionModel();
                $postulacion->setUsuario($empleado);
                //Obtener todas las postulaciones
                $postulaciones = $postulacion->obtenerPostulaciones();
                //Retorno de datos
                return $postulaciones;
            }

        }
        //Obtener los detalles de un usuario
        public function detallesUsuario(){
            //Validar que exista el metodo post
            if(isset($_POST['id'])){
                //Almacenamiento del id del empleado
                $id = (int)$_POST['id'];
                $detalle = new EmpleadoModel();
                $detalle->setId($id);
                //Datos del empleado correspondiente
                $detalles = $detalle->detallesEmpleado();
                //Retorno de datos
                return $detalles;
            }

        }
        //Función para validar una postulación
        public function validarUnaPostulacion(){

            if(isset($_POST)){
                //Almacenamiento de los datos
                $empleo = $_POST['codigo'];
                $usuario = $_SESSION['empleado']->id;
                //Instancia de la clase Postulación
                $validado = new PostulacionModel();
                //Sets
                $validado->setUsuario($usuario);
                $validado->setEmpleo($empleo);
                //Metodo que valida que un usuario esté en una postulación
                $validados = $validado->validarUnaPostulacion();
                //Retorno de dato
                return $validados;

            }

        }
        //Cantidad de postulaciones según el estado
        public function reportePostulacionesEstado(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $estado = $_POST['postulacion'];

                $contar = new PostulacionModel();
                $contar->setEstado($estado);
                $contado = $contar->reportePostulacionesEstado();

                return $contado;

            }

        }
        //Cantidad de postulaciones según las fechas
        public function reportePostulacionesFecha(){
            //Verificar que exista la sesión del admin
            if(isset($_SESSION['admin']) && isset($_POST)){

                $fecha_inicial = $_POST['fecha_inicial'];
                $fecha_final = $_POST['fecha_final'];

                $contar = new PostulacionModel();
                $contar->setFecha($fecha_inicial);
                $contar->setFechaFinal($fecha_final);
                $contado = $contar->reportePostulacionesFecha();

                return $contado;

            }

        }

    }