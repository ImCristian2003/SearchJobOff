<?php

    class CalificacionModel{

        //Campos que se usarán en esta clase 
        private $codigo;
        private $usuario;
        private $calificacion;
        private $descripcion;
        private $fecha;
        private $fecha_final;
        private $db;

        //Constructor que hará uso de la conexion a la base de datos
        public function __construct()
        {
            $this->db = Conexion::connection();
        }

        //Get y set para codigo
        public function getCodigo(){
            return $this->codigo;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        //Get y set para usuario
        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        //Get y set para calificacion
        public function getCalificacion(){
            return $this->calificacion;
        }

        public function setCalificacion($calificacion){
            $this->calificacion = $calificacion;
        }

        //Get y set para descripcion
        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        //Get y set para fecha
        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        //Get y set para fecha_final
        public function getFechaFinal(){
            return $this->fecha_final;
        }

        public function setFechaFinal($fecha_final){
            $this->fecha_final = $fecha_final;
        }

        //Funciones para consultar a la base de datos
        //Conseguir todas las calificaciones
        public function conseguirCalificaciones(){
            //Consulta para sacar todos los registros
            $sql = "SELECT ca.*, us.nombre as 'nombre_usuario', us.estado, us.apellido FROM calificacion as ca
            INNER JOIN usuario as us
            ON ca.usuario = us.id
            WHERE us.estado = '1'
            ORDER BY ca.codigo DESC";
            $calificacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($calificacion){
                //Almacenar los datos en la variable a retornar
                $validar = $calificacion;
            }
            //Retorno del resultado
            return $validar;

        }
        //Conseguir las calificaciones de un usuario en concreto
        public function conseguirCalificacionesUsuario(){
            //Consulta para sacar todos los registros según el usuario
            $sql = "SELECT ca.*, us.nombre as 'nombre_usuario', us.apellido, us.id FROM calificacion as ca
            INNER JOIN usuario as us
            ON ca.usuario = us.id
            WHERE us.id = '{$this->getUsuario()}'
            ORDER BY ca.codigo DESC";
            $calificacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($calificacion){
                //Almacenar los datos en la variable a retornar
                $validar = $calificacion;
            }
            //Retorno del resultado
            return $validar;

        }
        //Guardar una calificación
        public function guardarCalificacion(){

            $sql = "INSERT INTO calificacion VALUES(NULL,'{$this->getUsuario()}',{$this->getCalificacion()},
            '{$this->getDescripcion()}',NOW())";
            $guardar = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($guardar){
                //Almacenar true en la variable a retornar
                $validar = true;
            }
            //Retorno del resultado
            return $validar;

        }
        //eliminar una calificación
        public function eliminarCalificacion(){

            $sql = "DELETE FROM calificacion WHERE codigo = {$this->getCodigo()}";
            $borrar = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($borrar){
                //Almacenar true en la variable a retornar
                $validar = true;
            }
            //Retorno del resultado
            return $validar;

        }
        //Eliminar las calificaciones de un usuario
        public function eliminarUsuario(){
            //Consulta que elimina la calificacion según el usuario
            $sql = "DELETE FROM calificacion WHERE usuario = {$this->getUsuario()}";
            $eliminar_calificacion_usuario = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar_calificacion_usuario){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Cantidad de municipios registrados
        public function contarCalificaciones(){

            //Sacar la cantidad de calificaciones
            $sql = "SELECT COUNT(codigo) as 'calificaciones' FROM calificacion";
            $login = $this->db->query($sql);

            $result = false;
            //Comprobar que la consulta funcione y devuelva un solo registro
            if($login){
                $result = $login->fetch_object();
            }

            //Retornar el resultado del proceso
            return $result;

        }
        //Conseguir las calificaciones segun la cantidad de estrellas
        public function reporteCalificacionesEstrellas(){
            //Consulta para sacar todos los registros según las estrellas
            $sql = "SELECT ca.*, us.id, us.nombre FROM calificacion as ca 
            INNER JOIN usuario as us 
            ON ca.usuario = us.id
            WHERE ca.calificacion = {$this->getCalificacion()}";
            $calificacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($calificacion){
                //Almacenar los datos en la variable a retornar
                $validar = $calificacion;
            }
            //Retorno del resultado
            return $validar;

        }
        //Conseguir las calificaciones segun la fecha inicial y final
        public function reporteCalificacionesFecha(){
            //Consulta para sacar todos los registros según las fechas
            $sql = "SELECT ca.*, us.id, us.nombre FROM calificacion as ca 
            INNER JOIN usuario as us 
            ON ca.usuario = us.id
            WHERE ca.fecha BETWEEN '{$this->getFecha()}' AND '{$this->getFechaFinal()}'";
            $calificacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($calificacion){
                //Almacenar los datos en la variable a retornar
                $validar = $calificacion;
            }
            //Retorno del resultado
            return $validar;

        }

    }