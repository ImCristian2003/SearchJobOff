<?php

    class DepartamentoModel{

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

        //Funciones para consultar a la base de datos
        public function mostrarDepartamento(){

            //Consulta para sacar todos los registros de un departamento
            $sql = "SELECT * FROM departamento ORDER BY nombre";
            $departamento = $this->db->query($sql);
            //Variable a retornar
            $validar = false;
            //En caso de que la consulta se ejecute bien, almacenar los datos en la variable
            //a retornar
            if($departamento){
                $validar = $departamento;
            }
            //Retornar la variable
            return $validar;

        }
    }