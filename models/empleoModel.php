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
        //Obtener empleos por busqueda
        public function obtenerEmpleos(){
            //Trozo de consulta inicial
            $sql = "SELECT * FROM empleo ";
            //En caso de que digite el nombre pero no filtre un municipio
            if(!empty($this->nombre) && $this->municipio == 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' ";
            }
            //En caso de que no digite el nombre pero si filtre un municipio
            if(empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE municipio = {$this->municipio} ";
            }
            //En caso de que digite el nombre y filtre un municipio
            if(!empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' AND municipio = {$this->municipio} ";
            }
            //Trozo final para priorizar los ultimos subidos
            $sql .= " ORDER BY codigo DESC ";

            $empleo = $this->db->query($sql);
            //Variable a retornar
            $val = false;
            //En caso de que funcione la consulta
            if($empleo){
                //Almacenamiento de datos
                $val = $empleo;
            }
            //Retorno del resultado
            return $val;

        }
        //Obtener un solo empleo
        public function obtenerUno(){
            //Consulta que trae todos los datos del empleo y además el nombre correspondiente
            //de cada clave foranea(codigo -> nombre)
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
            //Variable a retornar
            $val = false;
            //En caso de que funcione
            if($empleo){
                //Almacenar los campos ya convertidos a un array asociativo
                $val = $empleo->fetch_object();
            }
            //Retornar el resultado
            return $val;

        }
        //Guardar un empleo
        public function guardarEmpleo(){
            //Consulta que guarda el registro completo de un empleo
            $sql = "INSERT INTO empleo VALUES(null,'{$this->getNombre()}',
            {$this->getMunicipio()},'{$this->getDireccion()}',{$this->getCargo()},
            {$this->getVacantes()},'{$this->getJornada()}','{$this->getExperiencia()}',
            {$this->getSector()},'{$this->getFuncion()}','{$this->getEmpresa()}',
            '{$this->getDescripcion()}',{$this->getSalario()},{$this->getTipoContrato()},
            '{$this->getLogo()}')";

            $guardar = $this->db->query($sql);
            //Variable a retornar
            $validar = false;
            //En caso de que funcione asignarle un true a la variable a retornar
            if($guardar){
                $validar = true;
            }
            //Retorno del resultado
            return $validar;

        }
        //Función que muesra los empleos publicados por una empresa
        public function empleosPublicados(){
            //Consulta para mostrar todos los empleos publicados por una 
            //su respectiva empresa
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
            //Variable a retornar
            $mostrar = false;
            //En caso de que funcione, asignar los datos a la variable a retornar
            if($consulta){
                $mostrar = $consulta;
            }
            //Retornar la variable
            return $mostrar;

        }
        //Eliminar un empleo
        public function eliminarEmpleo(){
            //Consulta que elimina el registro de un empleo correspondiente
            $sql = "DELETE FROM empleo WHERE codigo = {$this->getCodigo()}";
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
        //Eliminar un empleo - Municipio
        public function eliminarEmpleoMunicipio(){
            //Consulta que elimina el registro de un empleo correspondiente
            $sql = "DELETE FROM empleo WHERE municipio = {$this->getMuncipio()}";
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
        //Modificar los datos de un empleo
        public function modificarEmpleo(){
            //Consulta que modifica los datos correspondientes de un empleo en concreto
            $sql = "UPDATE empleo SET nombre = '{$this->getNombre()}',
            municipio = {$this->getMunicipio()}, direccion = '{$this->getDireccion()}',
            cargo = {$this->getCargo()}, vacantes = {$this->getVacantes()},
            jornada = '{$this->getJornada()}', experiencia = '{$this->getExperiencia()}',
            sector = '{$this->getSector()}', funcion = '{$this->getFuncion()}',
            descripcion = '{$this->getDescripcion()}', salario = {$this->getSalario()}, 
            tipo_contrato = {$this->getTipoContrato()}, logo = '{$this->getLogo()}' 
            WHERE codigo = {$this->getCodigo()}";

            $mod = $this->db->query($sql);
            //Variable a retornar
            $modificado = false;
            //En caso de que funcione asignar un true a la variable a retornar
            if($mod){
                $modificado = true;
            }
            //Retornar el resultado
            return $modificado;

        }
        //Restar vacantes a un empleo
        public function restarVacante(){
            //Consulta que carga la nueva cantidad de vacantes
            $sql = "UPDATE empleo SET vacantes = {$this->getVacantes()}
            WHERE codigo = '{$this->getCodigo()}'";
            $vacante = $this->db->query($sql);
            //Variable a retornar
            $vacantes = false;
             //En caso de que funcione asignar un true a la variable a retornar
            if($vacante){
                $vacantes = true;
            }
            //Retornar el resultado
            return $vacantes;

        }
        //Eliminar los empleos según el usuario
        public function eliminarUsuario(){
            //Consulta que elimina la calificacion según el usuario
            $sql = "DELETE FROM empleo WHERE empresa = '{$this->getEmpresa()}'";
            $eliminar_empleo_usuario = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar_empleo_usuario){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Obtener empleos por busqueda
        public function obtenerEmpleosBorrar(){
            //Trozo de consulta inicial
            $sql = "SELECT codigo FROM empleo WHERE empresa = '{$this->getEmpresa()}'";
            //En caso de que digite el nombre pero no filtre un municipio
            if(!empty($this->nombre) && $this->municipio == 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' ";
            }
            //En caso de que no digite el nombre pero si filtre un municipio
            if(empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE municipio = {$this->municipio} ";
            }
            //En caso de que digite el nombre y filtre un municipio
            if(!empty($this->nombre) && $this->municipio != 0){
                $sql .= " WHERE nombre LIKE '%{$this->nombre}%' AND municipio = {$this->municipio} ";
            }
            //Trozo final para priorizar los ultimos subidos
            $sql .= " ORDER BY codigo DESC ";

            $empleo = $this->db->query($sql);
            //Variable a retornar
            $val = false;
            //En caso de que funcione la consulta
            if($empleo){
                //Almacenamiento de datos
                $val = $empleo;
            }
            //Retorno del resultado
            return $val;

        }
        //Obtener empleos por busqueda
        public function obtenerEmpleosBorrarFK(){
            //Trozo de consulta inicial
            $sql = "SELECT codigo FROM empleo WHERE municipio = '{$this->getMunicipio()}'";
            $empleo = $this->db->query($sql);
            //Variable a retornar
            $val = false;
            //En caso de que funcione la consulta
            if($empleo){
                //Almacenamiento de datos
                $val = $empleo;
            }
            //Retorno del resultado
            return $val;

        }

    }