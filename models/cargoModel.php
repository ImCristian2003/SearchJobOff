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

        //Guardar un cargo
        public function guardarCargo(){

            $sql = "INSERT INTO cargo VALUES(null,'{$this->getNombre()}')";
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
        //Eliminar un cargo
        public function eliminarCargo(){
            //Consulta que elimina el registro de un empleo correspondiente
            $sql = "DELETE FROM cargo WHERE codigo = {$this->getCodigo()}";
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