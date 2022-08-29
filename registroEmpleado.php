<?php  

    if(!isset($_GET['controller']) == 'UsuarioController' && !isset($_GET['action']) == 'guardarEmpleado'){
        echo "La pagina web no existe";
    }

?>