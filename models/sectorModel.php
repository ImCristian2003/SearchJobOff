<?php

    class SectorModel{

        //Campos que se usarán en esta clase 
        private $codigo;
        private $nombre;
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

        //Funciones para consultar a la base de datos
        public function conseguirSector(){

            $sql = "SELECT * FROM sector ORDER BY nombre";
            $sector = $this->db->query($sql);

            $validar = false;

            if($sector){
                $validar = $sector;
            }

            return $validar;

        }

    }