<?php

    class EmpleoModel{

        private $codigo;
        private $nombre;
        private $municipio;
        private $direccion;
        private $cargo;
        private $vacantes;
        private $jornada;
        private $experiencia;
        private $sector;
        private $funcion;
        private $empresa;
        private $descripcion;
        private $salario;
        private $logo;
        private $tipo_contrato;
        //Variable que hace uso de la conexión a la base de datos
        private $db;

        //Constructor que hace uso de la conexion a la base de datos
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

        //Get y set para municipio
        public function getMunicipio(){
            return $this->municipio;
        }

        public function setMunicipio($municipio){
            $this->municipio = $municipio;
        }

        //Get y set para direccion
        public function getDireccion(){
            return $this->direccion;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }

        //Get y set para cargo
        public function getCargo(){
            return $this->cargo;
        }

        public function setCargo($cargo){
            $this->cargo = $cargo;
        }

        //Get y set para vacantes
        public function getVacantes(){
            return $this->vacantes;
        }

        public function setVacantes($vacantes){
            $this->vacantes = $vacantes;
        }

        //Get y set para jornada
        public function getJornada(){
            return $this->jornada;
        }

        public function setJornada($jornada){
            $this->jornada = $jornada;
        }

        //Get y set para experiencia
        public function getExperiencia(){
            return $this->experiencia;
        }

        public function setExperiencia($experiencia){
            $this->experiencia = $experiencia;
        }

        //Get y set para sector
        public function getSector(){
            return $this->sector;
        }

        public function setSector($sector){
            $this->sector = $sector;
        }

        //Get y set para funcion
        public function getFuncion(){
            return $this->funcion;
        }

        public function setFuncion($funcion){
            $this->funcion = $funcion;
        }

        //Get y set para empresa
        public function getEmpresa(){
            return $this->empresa;
        }

        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }

        //Get y set para descripcion
        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        //Get y set para salario
        public function getSalario(){
            return $this->salario;
        }

        public function setSalario($salario){
            $this->salario = $salario;
        }

        //Get y set para tipo_contrato
        public function getTipoContrato(){
            return $this->tipo_contrato;
        }

        public function setTipoContrato($tipo_contrato){
            $this->tipo_contrato = $tipo_contrato;
        }

        //Get y set para logo
        public function getLogo(){
            return $this->logo;
        }

        public function setLogo($logo){
            $this->logo = $logo;
        }

        //Funciones para hacer consultas a la base de datos
        public function obtenerEmpleos(){

            $sql = "SELECT * FROM empleo ";

            if(!empty($this->nombre) && $this->municipio == 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' ";
            }
            if(empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE municipio = {$this->municipio} ";
            }
            if(!empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' AND municipio = {$this->municipio} ";
            }

            $sql .= " ORDER BY codigo DESC ";

            $empleo = $this->db->query($sql);
        
            $val = false;
            if($empleo){
                $val = $empleo;
            }

            return $val;

        }

        public function obtenerUno(){

            $sql = "SELECT em.*, mu.nombre as 'nombre_municipio', ca.nombre as 'nombre_cargo', se.nombre as 'nombre_sector', 
            us.id as 'id_empresa', us.nombre as 'nombre_empresa', tp.nombre as 'nombre_tipocontrato' FROM empleo as em
            INNER JOIN municipio as mu
            ON em.municipio = mu.codigo
            INNER JOIN cargo as ca
            ON em.cargo = ca.codigo
            INNER JOIN sector as se
            ON em.sector = se.codigo
            INNER JOIN usuario as us
            ON em.empresa = us.id
            INNER JOIN tipo_contrato as tp
            ON em.tipo_contrato = tp.codigo
             WHERE em.codigo='{$this->codigo}'";
            $empleo = $this->db->query($sql);
        
            $val = false;
            if($empleo){
                $val = $empleo->fetch_object();
            }

            return $val;

        }

        public function guardarEmpleo(){

            $sql = "INSERT INTO empleo VALUES(null,'{$this->getNombre()}',
            {$this->getMunicipio()},'{$this->getDireccion()}',{$this->getCargo()},
            {$this->getVacantes()},'{$this->getJornada()}','{$this->getExperiencia()}',
            {$this->getSector()},'{$this->getFuncion()}','{$this->getEmpresa()}',
            '{$this->getDescripcion()}',{$this->getSalario()},{$this->getTipoContrato()},
            '{$this->getLogo()}')";

            $guardar = $this->db->query($sql);

            $validar = false;
            if($guardar){
                $validar = true;
            }

            return $validar;

        }

        public function empleosPublicados(){

            $sql = "SELECT em.*, mu.nombre as 'nombre_municipio', ca.nombre as 'nombre_cargo', se.nombre as 'nombre_sector', 
            us.id as 'id_empresa', tp.nombre as 'nombre_tipocontrato' FROM empleo as em
            INNER JOIN municipio as mu
            ON em.municipio = mu.codigo
            INNER JOIN cargo as ca
            ON em.cargo = ca.codigo
            INNER JOIN sector as se
            ON em.sector = se.codigo
            INNER JOIN usuario as us
            ON em.empresa = us.id
            INNER JOIN tipo_contrato as tp
            ON em.tipo_contrato = tp.codigo
            WHERE us.id = {$this->getEmpresa()}";

            $consulta = $this->db->query($sql);

            $mostrar = false;
            if($consulta){
                $mostrar = $consulta;
            }

            return $mostrar;

        }

        public function eliminarEmpleo(){

            $sql = "DELETE FROM empleo WHERE codigo = {$this->getCodigo()}";
            $eliminar = $this->db->query($sql);

            $eliminado = false;
            if($eliminar){
                $eliminado = true;
            }

            return $eliminado;

        }

        public function modificarEmpleo(){

            $sql = "UPDATE empleo SET nombre = '{$this->getNombre()}',
            municipio = {$this->getMunicipio()}, direccion = '{$this->getDireccion()}',
            cargo = {$this->getCargo()}, vacantes = {$this->getVacantes()},
            jornada = '{$this->getJornada()}', experiencia = '{$this->getExperiencia()}',
            sector = '{$this->getSector()}', funcion = '{$this->getFuncion()}',
            descripcion = '{$this->getDescripcion()}', salario = {$this->getSalario()}, 
            tipo_contrato = {$this->getTipoContrato()}, logo = '{$this->getLogo()}' 
            WHERE codigo = {$this->getCodigo()}";

            $mod = $this->db->query($sql);

            $modificado = false;
            if($mod){
                $modificado = true;
            }

            return $modificado;

        }

        public function restarVacante(){

            $sql = "UPDATE empleo SET vacantes = {$this->getVacantes()}
            WHERE codigo = '{$this->getCodigo()}'";
            $vacante = $this->db->query($sql);

            $vacantes = false;
            if($vacante){
                $vacantes = true;
            }

            return $vacantes;

        }

    }