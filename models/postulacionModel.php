<?php

    class PostulacionModel{

        private $codigo;
        private $usuario;
        private $empleo;
        private $estado;
        private $fecha;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexión a la base de datos
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

        //Get y set para empleo
        public function getEmpleo(){
            return $this->empleo;
        }

        public function setEmpleo($empleo){
            $this->empleo = $empleo;
        }

        //Get y set para estado
        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        //Get y set para fecha
        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        //Funciones para consultar a la base de datos
        public function guardarPostulacion(){

            $sql = "INSERT INTO postulacion VALUES(null,'{$this->getUsuario()}',{$this->getEmpleo()},'Pendiente',CURDATE())";
            $guardar = $this->db->query($sql);

            $save = false;
            if($guardar){
                $save = true;
            }

            return $save;

        }

    }