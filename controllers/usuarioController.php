<?php

    require_once 'models/usuarioModel.php';

    class UsuarioController{

        public function registrarEmpleado(){

            require_once "views/registroEmpleadoView.php";

        }

        public function guardarEmpleado(){

            if(isset($_POST)){

                $usuario = new UsuarioModel();
                $usuario->setId($_POST['id']);
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellidos($_POST['apellidos']);
                $usuario->setTelefono($_POST['telefono']);
                $usuario->setDireccion($_POST['direccion']);
                $usuario->setCorreo($_POST['correo']);
                $usuario->setPassword($_POST['password']);
                $usuario->setPerfil($_POST['perfil']);
                $usuario->setHojaVida($_POST['hoja_vida']);

                $save = $usuario->save();
                if($save){
                    $_SESSION['registro'] = "Registro completado exitosamente";
                }else{
                    $_SESSION['registro'] = "Registro fallido";
                }

            }else{
                $_SESSION['registro'] = "Registro fallido";
            }
            header("Location: registro.php");

        }

    }