<?php

    class PostulacionModel{

        private $codigo;
        private $usuario;
        private $empleo;
        private $estado;
        private $fecha;
        private $empresa;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexión a la base de datos
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

        //Get y set para usuario
        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        //Get y set para empleo
        public function getEmpleo(){
            return $this->empleo;
        }

        public function setEmpleo($empleo){
            $this->empleo = $empleo;
        }

        //Get y set para estado
        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        //Get y set para fecha
        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        //Get y set para empresa
        public function getEmpresa(){
            return $this->empresa;
        }

        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }

        //Funciones para consultar a la base de datos
        public function guardarPostulacion(){

            $sql = "INSERT INTO postulacion VALUES(null,'{$this->getUsuario()}',{$this->getEmpleo()},'Pendiente',CURDATE())";
            $guardar = $this->db->query($sql);

            $save = false;
            if($guardar){
                $save = true;
            }

            return $save;

        }

        public function obtenerPostulados(){

            $sql = "SELECT us.nombre as 'usuario', us.id , em.codigo as 'codigo_empleo', em.nombre as 'empleo',
            em.funcion, em.vacantes, em.descripcion, em.empresa,  po.codigo as 'codigo_postulacion',po.estado, po.fecha 
            FROM postulacion as po
            INNER JOIN usuario as us
            ON po.usuario = us.id
            INNER JOIN empleo as em
            ON po.empleo = em.codigo
            WHERE em.empresa = {$this->getEmpresa()}";
            $postulado = $this->db->query($sql);
    
            $mostrar = false;

            if($postulado){
                $mostrar = $postulado;
            }

            return $mostrar;

        }

        public function obtenerPostulaciones(){

            $sql = "SELECT us.nombre as 'usuario', us.id as 'usuario_id' ,
            em.*, po.codigo as 'codigo_postulacion', po.estado, po.fecha FROM postulacion as po 
            INNER JOIN usuario as us ON po.usuario = us.id INNER JOIN empleo as em 
            ON po.empleo = em.codigo WHERE us.id = {$this->getUsuario()}";
            $postulacion = $this->db->query($sql);
    
            $mostrar = false;

            if($postulacion){
                $mostrar = $postulacion;
            }

            return $mostrar;

        }

        public function eliminarPostulacion(){

            $sql = "DELETE FROM postulacion WHERE empleo = {$this->getEmpleo()}";
            $eliminar = $this->db->query($sql);

            $eliminado = false;
            if($eliminar){
                $eliminado = true;
            }

            return $eliminado;

        }

        public function eliminarPostulacionUsuario(){

            $sql = "DELETE FROM postulacion WHERE usuario = {$this->getUsuario()} AND empleo = {$this->getEmpleo()}";
            $eliminar_postulacion_usuario = $this->db->query($sql);

            $eliminado = false;
            if($eliminar_postulacion_usuario){
                $eliminado = true;
            }

            return $eliminado;

        }

        public function cambiarEstado(){

            $sql = "UPDATE postulacion SET estado = '{$this->getEstado()}' 
            WHERE codigo = {$this->getCodigo()}";
            $cambiar = $this->db->query($sql);

            $cambiado = false;
            if($cambiar){
                $cambiado = true;
            }

            return $cambiado;

        }

        public function eliminarPostulacionEstado(){

            $sql = "DELETE FROM postulacion WHERE codigo = {$this->getCodigo()}";
            $eliminar = $this->db->query($sql);

            $eliminado = false;
            if($eliminar){
                $eliminado = true;
            }

            return $eliminado;

        }

    }