<?php

    require_once "../../models/adminModel.php";
    require_once "../../models/empleadoModel.php";

    class AdminController{

        public function conseguirEmpleados(){

            if(isset($_SESSION['admin'])){

                $empleado = new EmpleadoModel();
                $empleados = $empleado->conseguirEmpleados();

                return $empleados;

            }

        }

    }