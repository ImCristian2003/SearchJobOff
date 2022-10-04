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
        //Sacar registros de la tabla tipo sector
        public function conseguirTipoContrato(){
            //Consulta que saca todos los registros
            $sql = "SELECT * FROM tipo_contrato ORDER BY nombre";
            $tipo = $this->db->query($sql);

            $validar = false;
            //en caso de funcionar se almacenan todos los datos en la variable
            //a retornar
            if($tipo){
                $validar = $tipo;
            }
            //Retorno de la variable
            return $validar;

        }
        //Guardar un tipo de contrato
        public function guardarContrato(){

            $sql = "INSERT INTO tipo_contrato VALUES(null,'{$this->getNombre()}')";
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
        //Eliminar un contrato
        public function eliminarContrato(){
            //Consulta que elimina el registro de un empleo correspondiente
            $sql = "DELETE FROM tipo_contrato WHERE codigo = {$this->getCodigo()}";
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