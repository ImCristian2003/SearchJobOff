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

        //Get y set para departamento
        public function getDepartamento(){
            return $this->departamento;
        }

        public function setDepartamento($departamento){
            $this->departamento = $departamento;
        } 

        //Funciones para consultar a la base de datos
        public function mostrarMunicipios(){

            //Consulta para sacar todos los registros de un municipio
            $sql = "SELECT * FROM municipio ORDER BY nombre";
            $municipio = $this->db->query($sql);
            //Variable a retornar
            $validar = false;
            //En caso de que la consulta se ejecute bien, almacenar los datos en la variable
            //a retornar
            if($municipio){
                $validar = $municipio;
            }
            //Retornar la variable
            return $validar;

        }

        //Guardar un municipio
        public function guardarMunicipio(){

            $sql = "INSERT INTO municipio VALUES({$this->getCodigo()},'{$this->getNombre()}',{$this->getDepartamento()})";
            $guardar = $this->db->query($sql);
            //Variable a retornar
            $guardado = false;
            //En caso de que funcione asignar un true a la variable a retornar
            if($guardar){
                $guardado = true;
            }
            //Retornar la variable
            return $guardado;

        }

        //Funciones para consultar a la base de datos
        public function conseguirMunicipios(){

            //Consulta para sacar todos los registros de un municipio
            $sql = "SELECT mu.*, de.nombre as 'nombre_dep', de.codigo as 'codigo_dep' 
            FROM municipio as mu
            INNER JOIN departamento as de 
            ON mu.departamento = de.codigo
            ORDER BY nombre";
            $municipio = $this->db->query($sql);
            //Variable a retornar
            $validar = false;
            //En caso de que la consulta se ejecute bien, almacenar los datos en la variable
            //a retornar
            if($municipio){
                $validar = $municipio;
            }
            //Retornar la variable
            return $validar;

        }
        //Eliminar un municipio
        public function eliminarMunicipio(){
            //Consulta que elimina el registro de un empleo correspondiente
            $sql = "DELETE FROM municipio WHERE codigo = {$this->getCodigo()}";
            $eliminar = $this->db->query($sql);
            //Variable a retornar
            $eliminado = false;
            //En caso de que funcione asignar un true a la variable a retornar
            if($eliminar){
                $eliminado = true;
            }
            //Retornar la variable
            return $eliminado;

        }

    }