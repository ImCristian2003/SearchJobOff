<?php

session_start();
//Inclusión del autoload (Archivo que cargará automaticamente los controladores)
require_once 'autoload.php';
require_once 'config/conexion.php';
//Libreria de funciones
require_once 'helpers/utils.php';

//funcion para el caso de que los parametros tanto del controlador como de la accion, si existan
//pero no tengan un valor correcto asignado
function show_error(){
	$error = new ErrorController();
	$error->index();
}

//Condición para saber si existe el parametro que indicará el controlador
if(isset($_GET['controller'])){
    //Nombre del controlador + la palabra reservada 'Controller'
	$nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){//Condicion en caso de que no exista ni
	//el controlador, ni la acción

	//Asignacion al nombre del controlador
	$nombre_controlador = controller_default;


}else{
	show_error();
	exit();
}

//Condición para saber si existe la clase con el nombre del controlador
//(La clase y el nombre del archivo siempre deben llamarsen de manera igual (Recomendable))
if(class_exists($nombre_controlador)){	

    //Creación de la instancia del controlador
	$controlador = new $nombre_controlador();
	
    //Se evalua que exista el parametro 'action' que indicará el metodo a ejecutar
    //y a su vez que el metodo exista
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){

        //Nombre de la acción
		$action = $_GET['action'];

        //Ejecución del metodo
		$controlador->$action();
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){//Condicion en caso de que no exista ni
		//el controlador, ni la acción
	
		//Asignación del nombre de la accion
		$default = action_default;
		$controlador->$default();
		
	
	}else{
		show_error();
	}
}else{
	show_error();
}