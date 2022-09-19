<?php

    class MunicipioModel{

        //Campos que se usarán en esta clase 
        private $codigo;
        private $nombre;
        private $departamento;
        private $db;

        //Constructor que hará uso de la conexion a la base de datos
        public function __construct()
        {
            $this->db = Conexion::connection();
        }

        //Get y set para codigo
        public function getCodigo(){
            $this->codigo;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        //Get y set para nombre
        public function getNombre(){
            $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        //Get y set para departamento
        public function getDepartamento(){
            $this->departamento;
        }

        public function setDepartamento($departamento){
            $this->departamento = $departamento;
        } 

        //Funciones para consultar a la base de datos
        public function conseguirMunicipios(){

            $sql = "SELECT * FROM municipio ORDER BY nombre";
            $municipio = $this->db->query($sql);

            $validar = false;

            if($municipio){
                $validar = $municipio;
            }

            return $validar;

        }

    }