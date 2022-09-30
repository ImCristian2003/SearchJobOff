<?php

    //Clase para la tabla usuario - modelo
    class usuarioModel{

        //Se asignan los campos correspondientes a la base de datos
        private $id;
        private $nombre;
        private $apellidos;
        private $telefono;
        private $direccion;
        private $correo;
        private $contrasena;
        private $perfil;
        private $hoja_vida;
        private $imagen;
        private $nueva;
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

        //Get y Set para hoja de vida
        public function getHojaVida(){
            return $this->hoja_vida;
        }

        public function setHojaVida($hoja_vida){
            $this->hoja_vida = $hoja_vida;
        }

        //Get y Set para imagen de perfil
        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }

        //Get y Set para contraseña
        public function getNueva(){
            return password_hash($this->db->real_escape_string($this->nueva), PASSWORD_BCRYPT, ['cost'=>4]);
        }

        public function setNueva($nueva){
            $this->nueva = $nueva;
        }
        
        //Funciones para consultar a la base de datos
        //Funcion para comprobar la identificación del usuario
        public function login(){

            //Variable que se retorna
            $result = false;
            //Campos que utiliza el login
            $id = $this->id;
            $contrasena = $this->contrasena;

            //Comprobar si existe el usuario
            $sql = "SELECT * FROM usuario WHERE id='$id'";
            $login = $this->db->query($sql);

            //Comprobar que la consulta funcione y devuelva un solo registro
            if($login && $login->num_rows == 1){
                //Convertir lo que retorna la consulta a un array asociativo
                $usuario = $login->fetch_object();

                //Verificacion de la contraseña
                $verify = password_verify($contrasena, $usuario->contrasena);

                //Verificar que la contraseña coincida
                if($verify){
                    //Pasar los datos del usuario a una variable
                    $result = $usuario;
                }

            }

            //Retornar el resultado del proceso
            return $result;

        }
        //Cambiar la contraseña de un usuario
        public function cambiarContrasena(){

            //Variable que se retorna
            $result = false;
            //Campos que utiliza el login
            $id = $this->id;
            $contrasena = $this->contrasena;

            //Comprobar si existe el usuario
            $sql = "SELECT * FROM usuario WHERE id='$id'";
            $cambiar = $this->db->query($sql);

            //Comprobar que la consulta funcione y devuelva un solo registro
            if($cambiar && $cambiar->num_rows == 1){
                //Convertir lo que retorna la consulta a un array asociativo
                $usuario = $cambiar->fetch_object();

                //Verificacion de la contraseña
                $verify = password_verify($contrasena, $usuario->contrasena);

                //Verificar que la contraseña coincida
                if($verify){
                    //Si la contraseña coincide se hace un update con la nueva contraseña
                    //encryptada
                    $sql_cambiar = "UPDATE usuario SET contrasena = '{$this->getNueva()}'
                    WHERE id=$id";
                    $nueva = $this->db->query($sql_cambiar);
                    //Si todo sale bien, se almacena true en la variable a retornar
                    if($nueva){
                        $result = true;
                    }

                }

            }

            //Retornar el resultado del proceso
            return $result;

        }
        //Cambiar la contraseña de un usuario
        public function eliminarUsuario(){

            //Consulta para eliminar la consulta
            $sql = "DELETE FROM usuario WHERE id ='{$this->getId()}'";
            echo $sql;
            die();
            $cambiar = $this->db->query($sql);

            $result = false;
            //Comprobar que la consulta funcione 
            if($cambiar){
                $result = true;
            }

            //Retornar el resultado del proceso
            return $result;

        }

    }