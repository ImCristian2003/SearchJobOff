<?php
    session_start();
    //Uso de la librería para generar el PDF
    require_once "../../assets/libraries/vendor/autoload.php";

    require_once "../../config/conexion.php";
    require_once "../../helpers/utils.php";
    require_once "../../autoload.php";
    if(!isset($_SESSION['admin'])){
        header('Location: ../../index.php');
    } 
    //Instancia para sacar todos los empleados
    $campos = new AdminController();
    $campo = $campos->conseguirEmpleadosBlock();
    //Html que se va imprimír en el PDF (cuerpo)
    $html = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/icons/style.css">
        <link rel="stylesheet" href="css/normalize.css">
        <title>Empleados</title>
        <style>
    
            :root{
                --primario: rgb(105, 183, 185);
                --secundario: #f5f2f2;
                --gris: #B8B8B8;
                --blanco: #FFFFFF;
                --negro: #000000;
    
                --FuentePpal: "Dancing Script", cursive;
            }
    
            body{
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: "Roboto", sans-serif;
            }
    
            .container-postulados{
                width: 100%;
            }
    
            .container-postulados .details {
                margin: 2rem auto;
                text-align: center;
                width: 95%;
            }
    
            .container-postulados .details table{
                border-bottom: 1px solid #000;
                border-top: 1px solid #000;
                margin: 2rem auto;
                width:  80%;
            }
    
            .container-postulados .details table tr td, th{
                border: 1px solid #000;
                border-collapse: collapse;
                caption-side: bottom;
                padding: 0.5rem;
                text-align: center;
                vertical-align: top;
            }
    
            .container-postulados .details table tr th{
                background: var(--primario);
                color: #000;
                letter-spacing:1px;
            }
    
            .container-postulados .details table tr td{ 
                align-items:center;
                justify-content:center;
                padding:1rem 0rem;
                text-align:center;
            }
    
            .container-postulados .details table tr td a{
                background: var(--primario);
                border-radius:5px;
                color: #fff;
                letter-spacing:1px;
                padding: 0.6rem;
                text-decoration:none;
            }
    
            .container-postulados .details .volver{
                background: var(--primario);
                border-radius:5px;
                color: #fff;
                font-weight:bold;
                letter-spacing:2px;
                margin: 1rem;
                padding: 0.6rem 1.5rem;
                text-decoration:none;
            }
    
        </style>
    </head>
    <body>
        
        <div class="container-postulados">
            <div class="details">
                <h2>Empleados Registrados (Bloqueados)</h2>
                <table border="1">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                    </tr>
                    <!-----condición para validar que exista una sesión-------->0';
                    while($campos = $campo->fetch_object()){
                        $html .= '<tr>';
                            $html .= "<td>".$campos->id."</td>";
                            $html .= "<td>".$campos->nombre."</td>";
                            $html .= "<td>".$campos->apellido."</td>";
                            $html .= "<td>".$campos->telefono."</td>";
                            $html .= "<td>".$campos->direccion."</td>";
                            $html .= "<td>".$campos->correo."</td>";
                            $html .= "<td>".$campos->nombre_perfil."</td>";
                        $html .= '<tr>';
                    };
                $html .= '</table>
            </div>
        </div>
    
    </body>
    </html>';
    //Uso de la clase DOMPDF
    use Dompdf\Dompdf;
    //Proceso para imprimir todo el pdf
    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("empleados_bloqueados.pdf", array('Attachment'=>'0'));

?>