<?php

    class TipoContratoModel{

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
        public function conseguirTipoContrato(){

            $sql = "SELECT * FROM tipo_contrato ORDER BY nombre";
            $tipo = $this->db->query($sql);

            $validar = false;

            if($tipo){
                $validar = $tipo;
            }

            return $validar;

        }

    }