<?php

    require_once "../../assets/libraries/vendor/autoload.php";

    $html = "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <style>



        </style>
    </head>
    <body>
        
        <h1>Titulo documento</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis voluptatem eaque ab repudiandae, non dolore quo voluptate iure, reiciendis quaerat ducimus accusantium facilis nam fuga numquam minus accusamus voluptatibus excepturi?</p>

    </body>
    </html>";
    
    use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("documento.pdf", array('Attachment'=>'0'));
    