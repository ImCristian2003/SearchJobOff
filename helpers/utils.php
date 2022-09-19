<?php

    class Utils{

        public static function deleteSession($name){

            if(isset($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

        }

    }