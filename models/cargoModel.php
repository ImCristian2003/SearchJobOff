<?php

    class CargoModel{

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
        public function conseguirCargos(){
            //Consulta para sacar todos los registros
            $sql = "SELECT * FROM cargo ORDER BY nombre";
            $cargo = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($cargo){
                //Almacenar los datos en la variable a retornar
                $validar = $cargo;
            }
            //retorno del resultado
            return $validar;

        }

    }