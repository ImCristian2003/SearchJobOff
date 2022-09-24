<?php

    class EmpleoModel{

        private $codigo;
        private $nombre;
        private $municipio;
        private $direccion;
        private $cargo;
        private $vacantes;
        private $jornada;
        private $experiencia;
        private $sector;
        private $funcion;
        private $empresa;
        private $descripcion;
        private $salario;
        private $logo;
        private $tipo_contrato;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexion a la base de datos
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

        //Get y set para nombre
        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        //Get y set para municipio
        public function getMunicipio(){
            return $this->municipio;
        }

        public function setMunicipio($municipio){
            $this->municipio = $municipio;
        }

        //Get y set para direccion
        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }

        //Get y set para cargo
        public function getCargo(){
            return $this->cargo;
        }

        public function setCargo($cargo){
            $this->cargo = $cargo;
        }

        //Get y set para vacantes
        public function getVacantes(){
            return $this->vacantes;
        }

        public function setVacantes($vacantes){
            $this->vacantes = $vacantes;
        }

        //Get y set para jornada
        public function getJornada(){
            return $this->jornada;
        }

        public function setJornada($jornada){
            $this->jornada = $jornada;
        }

        //Get y set para experiencia
        public function getExperiencia(){
            return $this->experiencia;
        }

        public function setExperiencia($experiencia){
            $this->experiencia = $experiencia;
        }

        //Get y set para sector
        public function getSector(){
            return $this->sector;
        }

        public function setSector($sector){
            $this->sector = $sector;
        }

        //Get y set para funcion
        public function getFuncion(){
            return $this->funcion;
        }

        public function setFuncion($funcion){
            $this->funcion = $funcion;
        }

        //Get y set para empresa
        public function getEmpresa(){
            return $this->empresa;
        }

        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }

        //Get y set para descripcion
        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        //Get y set para salario
        public function getSalario(){
            return $this->salario;
        }

        public function setSalario($salario){
            $this->salario = $salario;
        }

        //Get y set para tipo_contrato
        public function getTipoContrato(){
            return $this->tipo_contrato;
        }

        public function setTipoContrato($tipo_contrato){
            $this->tipo_contrato = $tipo_contrato;
        }

        //Get y set para logo
        public function getLogo(){
            return $this->logo;
        }

        public function setLogo($logo){
            $this->logo = $logo;
        }

        //Funciones para hacer consultas a la base de datos
        public function obtenerEmpleos(){

            $sql = "SELECT * FROM empleo ";

            if(!empty($this->nombre) && $this->municipio == 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' ";
            }
            if(empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE municipio = {$this->municipio} ";
            }
            if(!empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' AND municipio = {$this->municipio} ";
            }

            $sql .= " ORDER BY codigo DESC ";

            $empleo = $this->db->query($sql);
        
            $val = false;
            if($empleo){
                $val = $empleo;
            }

            return $val;

        }

        public function obtenerUno(){

            $sql = "SELECT * FROM empleo WHERE codigo='{$this->codigo}'";
            $empleo = $this->db->query($sql);
        
            $val = false;
            if($empleo){
                $val = $empleo->fetch_object();
            }

            return $val;

        }

        public function guardarEmpleo(){

            $sql = "INSERT INTO empleo VALUES(null,'{$this->getNombre()}',
            {$this->getMunicipio()},'{$this->getDireccion()}',{$this->getCargo()},
            {$this->getVacantes()},'{$this->getJornada()}','{$this->getExperiencia()}',
            {$this->getSector()},'{$this->getFuncion()}','{$this->getEmpresa()}',
            '{$this->getDescripcion()}',{$this->getSalario()},{$this->getTipoContrato()},
            '{$this->getLogo()}')";

            echo $sql;
            die();

            $guardar = $this->db->query($sql);

            $validar = false;
            if($guardar){
                $validar = true;
            }

            return $validar;

        }

    }