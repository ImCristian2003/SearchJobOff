<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Mouse+Memoirs&family=Roboto&family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilosbuscador.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="assets/icons/style.css">
    <title>Buscar Empleo</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }
        :root{
            --primario: rgb(105, 183, 185);
            --secundario: #f5f2f2;
            --gris: #B8B8B8;
            --blanco: #FFFFFF;
            --negro: #000000;

            --FuentePpal: 'Dancing Script', cursive;
        }
        .container{
            display: flex;

            height: 100vh;
            width: 100%;
        }

        .caja-principal{
            display: flex;
            text-align: center;
            justify-content: center;
            flex-direction:column;

            height: 100vh;
            width: 70%;
        }
        .caja-principal .uno{
            height: 50%;
            width: 100%;

            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        .caja-principal .uno h2{
            font-size: 2.5rem;
        }
        .caja-principal .uno p{
            font-size: 1.4rem;
            margin: 2rem;
        }
        .caja-principal .dos{
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            background-color: var(--primario);
            border-radius: 0 85% 0 0;
            height: 50vh;
            width: 100%;
        }
        .caja-principal .dos h2{
            color: #fff;
            font-size: 3rem;
        }
        .caja-principal .dos .requerimientos{
            display: flex;
            flex-direction: column;
            
            color: var(--blanco);
            font-size: 1.6rem;
            list-style-type: none;
            margin: 1.6rem;
            padding: 1rem;
        }
        .caja-principal .dos li{
            margin: 0.5rem;
        }
        .caja-principal .icon-undo2{
            background-color: var(--primario);
            border-radius: 2rem;
            height: 3rem;
            width: 3rem;
            left: 15px;
            position: absolute;
            top: 15px;
            color: var(--blanco);

            display: flex;
            align-items: center;
            justify-content: center;
        }
        .caja-secundaria{
            height: 100vh;
            width: 30%;

            display: flex;
            flex-direction: column;
            justify-content: right; 
            align-items:center ;
            text-align: center;   
        }
        .caja-secundaria .empleo{
            background-color: #69B7B9;
            border-radius: 23% 0 20% 40%;
            height: 40vh;
            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;
        }
        .caja-secundaria .empleo img{
            height: 13rem;
            width: 15rem;
        }
        .caja-secundaria .detalles{
            height: 40vh;
            width: 100%;
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            align-items: center;
        }
        .caja-secundaria .detalles h2{
            font-size: 2.3rem;
            font-weight: bold;
        }
        .caja-secundaria .detalles li{
            font-size: 1.4rem;
            list-style-type: none;
            margin: 1.2rem;
        }
        .icon-checkmark{
            color: #69B7B9;
            left: 0;
            margin-right: 1.2rem;
        }
        .caja-secundaria .boton{
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;

            background-color: red;
            border-radius: 2rem;
            height: 12vh;
            width: 60%;
            position: relative;
        
        }
        .caja-secundaria .boton a{
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
        }



    </style>    
</head>
<body>
    <div class="container">
        <div class="caja-principal">
            <a href=""><span class="icon-undo2"></span></a>
            <div class="uno">
                <h2>Descripción.</h2>
                <p>Buscamos Estudiantes de Tecnología en sistematización en Datos, Análisis y desarrollo de sistemas de información (SENA) o Ing de Sistemas.
                Preferiblemente con conocimiento en creación de casos de uso e historias de usuario.
                Se encargará de acompañar procesos de implementación y optimización para levantar y asegurar las pruebas funcionales de las soluciones de Software y/o aplicaciones a implementar en las campañas.
                </p>
            </div>
            <div class="dos">
                <h2>Requerimientos</h2>
                <ul class="requerimientos">
                    <li> <strong>Educación mínima: </strong> Universidad / Tecnología.</li>
                    <li> <strong>Disponibilidad de viajar: </strong> No.</li>
                    <li> <strong>Disponibilidad de cambio de residencia:</strong> No.</li>
                    <li> <strong>Personas con Discapacidad: </strong>  Sí.</li>
                </ul>
            </div>
        </div>
        <div class="caja-secundaria">
            <div class="empleo">
                <img src="assets/img/paraco.jpg" alt="">
            </div>
            <div class="detalles">
                <h2>Características del empleo.</h2>
                <ul>
                    <li><span class="icon-checkmark"></span>Saldo de 50'000.000 negociable</li>
                    <li><span class="icon-checkmark"></span>Término de contrato indefinido.</li>
                    <li><span class="icon-checkmark"></span>Posible ascenso a mayor cargo.</li>
                </ul>
            </div>
            <div class="boton">
                <a href=""> <span class="icon-notification"></span>    Debes registrarte para postularte.</a>     
            </div>

        </div>
    </div>

</body>
</html> 