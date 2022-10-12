<?php

    class PostulacionModel{
        //Campos que se usan en la clase
        private $codigo;
        private $usuario;
        private $empleo;
        private $estado;
        private $fecha;
        private $fecha_final;
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

        //Get y set para fecha_final
        public function getFechaFinal(){
            return $this->fecha_final;
        }

        public function setFechaFinal($fecha_final){
            $this->fecha_final = $fecha_final;
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

            $sql = "INSERT INTO postulacion VALUES(null,'{$this->getUsuario()}',{$this->getEmpleo()},'Pendiente',NOW())";
            $guardar = $this->db->query($sql);

            $save = false;
            if($guardar){
                $save = true;
            }

            return $save;

        }
        //Función para obtener los postulados a un empleo
        public function obtenerPostulados(){
            //Consulta que devuelve los postulados
            $sql = "SELECT us.nombre as 'usuario', us.correo, us.telefono, us.id , us.estado, em.codigo as 'codigo_empleo', em.nombre as 'empleo',
            em.funcion, em.vacantes, em.descripcion, em.empresa,  po.codigo as 'codigo_postulacion',po.estado, po.fecha 
            FROM postulacion as po
            INNER JOIN usuario as us
            ON po.usuario = us.id
            INNER JOIN empleo as em
            ON po.empleo = em.codigo
            WHERE em.empresa = {$this->getEmpresa()} AND us.estado = '1'";
            $postulado = $this->db->query($sql);
    
            $mostrar = false;
            //En caso de funcionar la consulta, se almacenan los datos en la variable
            //a retornar
            if($postulado){
                $mostrar = $postulado;
            }
            //Retorno de la variable
            return $mostrar;

        }

        //Obtener las postulaciones de un usuario
        public function obtenerPostulaciones(){
            //Consulta que devuelve las postulaciones de un usuario
            $sql = "SELECT us.nombre as 'usuario', us.id as 'usuario_id' ,
            em.*, po.codigo as 'codigo_postulacion', po.estado, po.fecha FROM postulacion as po 
            INNER JOIN usuario as us ON po.usuario = us.id INNER JOIN empleo as em 
            ON po.empleo = em.codigo WHERE us.id = {$this->getUsuario()}";
            $postulacion = $this->db->query($sql);
    
            $mostrar = false;
            //En caso de funcionar la consulta, se almacenan los datos en la variable
            //a retornar
            if($postulacion){
                $mostrar = $postulacion;
            }
            //Retorno de la variable
            return $mostrar;

        }
        //Eliminar una postulación
        public function eliminarPostulacion(){
            //Consulta que elimina la postulacion según el empleo
            $sql = "DELETE FROM postulacion WHERE empleo = {$this->getEmpleo()}";
            $eliminar = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Eliminar la postulacion de un usuario
        public function eliminarPostulacionUsuario(){
            //Consulta que elimina la postulación según el usuario
            $sql = "DELETE FROM postulacion WHERE usuario = {$this->getUsuario()} AND empleo = {$this->getEmpleo()}";
            $eliminar_postulacion_usuario = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar_postulacion_usuario){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Eliminar la postulacion de un usuario
        public function eliminarUsuario(){
            //Consulta que elimina la postulación según el usuario
            $sql = "DELETE FROM postulacion WHERE usuario = {$this->getUsuario()}";
            $eliminar_postulacion_usuario = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar_postulacion_usuario){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }

        //Eliminar la postulacion de un usuario
        public function eliminarEmpleo(){
            //Consulta que elimina la postulación según el usuario
            $sql = "DELETE FROM postulacion WHERE empleo = {$this->getEmpleo()}";
            $eliminar_postulacion_empleo = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar_postulacion_empleo){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Cambiar el estado de una postulación
        public function cambiarEstado(){
            //Consulta que carga el nuevo estado de la postulación
            $sql = "UPDATE postulacion SET estado = '{$this->getEstado()}' 
            WHERE codigo = {$this->getCodigo()}";
            $cambiar = $this->db->query($sql);

            $cambiado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($cambiar){
                $cambiado = true;
            }
            //Retorno de la variable
            return $cambiado;

        }
        //Eliminar postulación cuando un usuario sea rechazado
        public function eliminarPostulacionEstado(){
            //Consulta que elimina la postulación según la clave primaría
            $sql = "DELETE FROM postulacion WHERE codigo = {$this->getCodigo()}";
            $eliminar = $this->db->query($sql);

            $eliminado = false;
            //En caso de funcionar la consulta, se almacena true en la variable
            //a retornar
            if($eliminar){
                $eliminado = true;
            }
            //Retorno de la variable
            return $eliminado;

        }
        //Validar existencia de una postulación
        public function validarUnaPostulacion(){
            //Consulta que saca los datos según el usuario
            $sql = "SELECT * FROM postulacion WHERE usuario = '{$this->getUsuario()}' 
            AND empleo = {$this->getEmpleo()}";
            $empleo = $this->db->query($sql);

            $validado = false;
            //En caso de funcionar la consulta, se almacenan los datos en la variable
            //a retornar
            if($empleo){
                $validado = $empleo;
            }
            //Retorno de la variable
            return $validado;

        }
        //Conseguir las postulaciones según el estado
        public function reportePostulacionesEstado(){
            //Consulta para sacar todos los registros según el estado
            $sql = "SELECT po.*, us.id, us.nombre, em.codigo as 'codigo_empleo', em.nombre as 'nombre_empleo' FROM postulacion as po 
            INNER JOIN usuario as us 
            ON po.usuario = us.id
            INNER JOIN empleo as em 
            ON po.empleo = em.codigo
            WHERE po.estado = '{$this->getEstado()}'";
            $postulacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($postulacion){
                //Almacenar los datos en la variable a retornar
                $validar = $postulacion;
            }
            //Retorno del resultado
            return $validar;

        }
        //Conseguir las postulaciones según la fecha inicial y final
        public function reportePostulacionesFecha(){
            //Consulta para sacar todos los registros según las fechas
            $sql = "SELECT po.*, us.id, us.nombre, em.codigo as 'codigo_empleo', em.nombre as 'nombre_empleo' FROM postulacion as po 
            INNER JOIN usuario as us 
            ON po.usuario = us.id
            INNER JOIN empleo as em 
            ON po.empleo = em.codigo
            WHERE po.fecha BETWEEN '{$this->getFecha()}' AND '{$this->getFechaFinal()}'";
            $notificacion = $this->db->query($sql);

            $validar = false;
            //Si la consulta ejecutó
            if($notificacion){
                //Almacenar los datos en la variable a retornar
                $validar = $notificacion;
            }
            //Retorno del resultado
            return $validar;

        }

    }