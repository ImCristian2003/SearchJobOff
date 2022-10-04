<?php

    require_once "../../models/departamentoModel.php";

    class DepartamentoController{

        public function mostrarDepartamento(){

            if(isset($_SESSION['admin'])){

                $depart = new DepartamentoModel();
                $departamento = $depart->mostrarDepartamento();

                return $departamento;

            }

        }

    }