<?php
    //inicializar la sesión y usar la conexión a la base de datos
    session_start();
    require_once "config/conexion.php";
    require_once "helpers/utils.php";
    require_once "autoload.php";

    //Validar si existe la sesión del empleado, o no
    if(isset($_SESSION['empleado']) && isset($_GET['empleo'])){
        //Asignar los campos correspondiente
        $nombre = $_SESSION['empleado']->nombre;
        $apellidos = $_SESSION['empleado']->apellido;
        $email = $_SESSION['empleado']->correo;
        $mensaje = "Este es tu correo de verificación en consecuencia a la postulación que acabas de hacer a "."<b>".$_GET['empleo']."</b>";

    }else{
        //Asignar los campos correspondiente
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['correo'];
        $mensaje = $_POST['mensaje'];

    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "assets/libraries/vendor/autoload.php";

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'searchjob716@gmail.com';                     //SMTP username
        $mail->Password   = 'eyotxxbgetsjzmhn';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`                                      //Add a recipient              //Name is optional

        //Validar si existe la sesión del empleado, o no
        if(isset($_SESSION['empleado']) && isset($_GET['empleo'])){

            //Recipients
            $mail->setFrom('searchjob716@gmail.com', 'SearchJob');
            $mail->addAddress($email);  
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Postulacion Empleo';
            $mail->Body    = 'Hola '.$nombre.' '.$apellidos.'. Somos del equipo SearchJob: '.'<br>'.$mensaje;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        }else{
            //Recipients
            $mail->setFrom('searchjob716@gmail.com', 'SearchJob');
            $mail->addAddress('searchjob716@gmail.com');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Contacto directo desde el sitio web SearchJob';
            $mail->Body    = 'Hola! Soy '.$nombre.' '.$apellidos.'. Y este es mi mensaje: '.'<br>'.$mensaje.'<br>'.'Contacto: '.$email;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        }

        $mail->send();
        //Validar si existe la sesión del empleado, o no
        if(isset($_SESSION['empleado']) && isset($_GET['empleo'])){
            echo '<script> alert("Postulación realizada de forma exitosa"); window.location="views/usuario/usuarioPostulaciones.php"; </script>';
        }else{
            echo '<script> alert("Mensaje enviado de forma exitosa"); window.location="index.php"; </script>';
        }

    } catch (Exception $e) {
        echo "Hubo un error: {$mail->ErrorInfo}";
    }
