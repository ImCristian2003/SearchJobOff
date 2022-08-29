<?php

    class UsuarioModel{

        //Se asignan los campos correspondientes a la base de datos
        private $id;
        private $nombre;
        private $apellidos;
        private $telefono;
        private $direccion;
        private $correo;
        private $password;
        private $perfil;
        private $hoja_vida;
        private $db;

        /////////////////////////////CONSTRUCTOR
        public function __construct()
        {
            $this->db = Conexion::connection();
        }

        /////////////////////////////GET Y SET PARA EL ID
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        /////////////////////////////GET Y SET PARA EL NOMBRE
        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $this->db->real_escape_string($nombre);
        }

        /////////////////////////////GET Y SET PARA EL APELLIDOS
        public function getApellidos(){
            return $this->apellidos;
        }

        public function setApellidos($apellidos){
            $this->apellidos = $this->db->real_escape_string($apellidos);
        }

        /////////////////////////////GET Y SET PARA EL TELEFONO
        public function getTelefono(){
            return $this->telefono;
        }

        public function setTelefono($telefono){
            $this->telefono = $this->db->real_escape_string($telefono);
        }

        /////////////////////////////GET Y SET PARA LA DIRECCION
        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $this->db->real_escape_string($direccion);
        }

        /////////////////////////////GET Y SET PARA EL CORREO
        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo = $this->db->real_escape_string($correo);
        }

        /////////////////////////////GET Y SET PARA EL PASSWORD
        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost'=>4]);
        }

        /////////////////////////////GET Y SET PARA EL ROL
        public function getPerfil(){
            return $this->perfil;
        }

        public function setPerfil($perfil){
            $this->perfil = $perfil;
        }

        /////////////////////////////GET Y SET PARA EL IMAGE
        public function getHojaVida(){
            return $this->hoja_vida;
        }

        public function setHojaVida($hoja_vida){
            $this->hoja_vida = $hoja_vida;
        }
        
        /////////////////////////////METODOS PARA CONSULTAR A LA BD
        public function save(){
            
            
            $sql = "INSERT INTO usuarios VALUES('{$this->getId()}','{$this->getNombre()}','{$this->getApellidos()}','{$this->getTelefono()}','{$this->getDireccion()}','{$this->getCorreo()}','{$this->getPassword()}','{$this->getPerfil()}','{$this->getHojaVida()}')";
            $save = $this->db->query($sql);

            $result = false;
            if($save){
                $result = true;
            }
            
            return $result;

        }
    
        

    }