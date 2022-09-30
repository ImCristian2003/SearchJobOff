<?php

    class AdminModel{

        //Se asignan los campos correspondientes a la base de datos
        private $id;
        private $nombre;
        private $apellidos;
        private $telefono;
        private $direccion;
        private $correo;
        private $contrasena;
        private $perfil;
        private $imagen;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexión a la base de datos
        public function __construct()
        {
            $this->db = Conexion::connection();
        }

        //Get y Set para id
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        //Get y Set para nombre
        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $this->db->real_escape_string($nombre);
        }

        //Get y Set para apellidos
        public function getApellidos(){
            return $this->apellidos;
        }

        public function setApellidos($apellidos){
            $this->apellidos = $this->db->real_escape_string($apellidos);
        }

        //Get y Set para telefono
        public function getTelefono(){
            return $this->telefono;
        }

        public function setTelefono($telefono){
            $this->telefono = $this->db->real_escape_string($telefono);
        }

        //Get y Set para direccion
        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $this->db->real_escape_string($direccion);
        }

        //Get y Set para correo
        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $this->db->real_escape_string($correo);
        }

        //Get y Set para contraseña
        public function getContrasena(){
            return password_hash($this->db->real_escape_string($this->contrasena), PASSWORD_BCRYPT, ['cost'=>4]);
        }

        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
        }

        //Get y Set para perfil
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
        
        //Funciones para consultar a la base de datos
        public function guardarAdmin(){
            
            //Consulta para insertar los datos a la tabla usuario
            $sql = "INSERT INTO usuario VALUES('{$this->getId()}','{$this->getNombre()}','{$this->getApellidos()}','{$this->getTelefono()}','{$this->getDireccion()}','{$this->getCorreo()}','{$this->getContrasena()}',{$this->getPerfil()},null,null)";
            $save = $this->db->query($sql);

            //Variable que se retorna
            $result = false;
            //Evaluar que la consulta se halla ejecutado correctamente
            if($save){
                $result = true;
            }
            //Retorno de la variable
            return $result;

        }
        
    }