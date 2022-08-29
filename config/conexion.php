<?php

    class Conexion{

        public static function connection(){

            //Mysqli para generar la conexion
            $db = new mysqli("localhost","root","","searchjob");

            //Consulta para que los campos lleguen con tildes y ñ
            $db->query("SET NAMES 'utf8'");

            //Retornar la conexion a la bd
            return $db;

        }

    }