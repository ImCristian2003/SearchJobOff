<?php

    class EmpresaModel{

        //Declaración de variables que usa esta clase
        private $nit;
        private $nombre;
        private $telefono;
        private $direccion;
        private $email;
        private $contrasena;
        private $perfil;
        private $imagen;
        private $estado;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexion a la base de datos
        public function __construct()
        {
            $this->db = Conexion::connection();
        }

        //Get y set para nit
        public function getNit(){
            return $this->nit;
        }

        public function setNit($nit){
            $this->nit = $this->db->real_escape_string($nit);
        }

        //Get y set para nombre
        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $this->db->real_escape_string($nombre);
        }

        //Get y set para telefono
        public function getTelefono(){
            return $this->telefono;
        }

        public function setTelefono($telefono){
            $this->telefono = $this->db->real_escape_string($telefono);
        }

        //Get y set para direccion
        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $this->db->real_escape_string($direccion);
        }

        //Get y set para correo
        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $this->db->real_escape_string($correo);
        }

        //Get y set para contrasena
        public function getContrasena(){
            return password_hash($this->db->real_escape_string($this->contrasena), PASSWORD_BCRYPT, ['cost'=>4]);
        }

        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
        }

        //Get y set para perfil
        public function getPerfil(){
            return $this->perfil;
        }

        public function setPerfil($perfil){
            $this->perfil = $perfil;
        }

        //Get y Set para imagen de perfil
        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }

        //Get y set para estado
        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        //Funciones para hacer consultas a la base de datos
        //Funciones para guardar una empresa
        public function guardarEmpresa(){
            
            //Consulta que guarda el registro de una empresa
            $sql = "INSERT INTO usuario VALUES('{$this->getNit()}','{$this->getNombre()}',null,'{$this->getTelefono()}','{$this->getDireccion()}','{$this->getCorreo()}','{$this->getContrasena()}',{$this->getPerfil()},null,null,'1')";
            $save = $this->db->query($sql);

            //Variable a retornar
            $result = false;
            //En caso de que funcione asignar un true a la variable a retornar
            if($save){
                $result = true;
            }
            //Retornar la variable
            return $result;

        }
        //Modificar los datos de una empresa
        public function modificarEmpresa(){

            //Variables para capturar los archivos
            $imagen = $this->imagen;

            //Consulta para modificar los datos de la base de datos
            $sql = "UPDATE usuario 
            SET nombre = '{$this->getNombre()}',
            telefono = '{$this->getTelefono()}',
            direccion = '{$this->getDireccion()}',
            correo = '{$this->getCorreo()}'";

            //Condición en caso de que la imagen de perfil no halla sido enviada
            if($imagen == "sin_perfil"){
                $img = true;
            }else{//En caso de que la envíe, se le concatena a la consulta un 
                //pedazo de codigo para guardar ese campo
                $sql .= ", imagen = '{$this->getImagen()}' ";
            }
            //Trozo que indica la empresa correspondiente
            $sql .= " WHERE id='{$this->getNit()}'";

            $modificar = $this->db->query($sql);
            //Variable a retornar
            $modificado = false;
            //En caso de que funcione asignar un true a la variable a retornar
            if($modificar){
                $modificado = true;
            }
            //Retorno de variable
            return $modificado;

        }

    }