<?php
    //inicializar la sesión y usar la conexión a la base de datos
    session_start();
    require_once "config/conexion.php";
    require_once "helpers/utils.php";
    require_once "autoload.php";
    //Validar que exista el metodo get
    if(isset($_GET)){

        $email = $_GET['correo'];
        $nueva = $_GET['nueva'];

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

        //Recipients
        $mail->setFrom('searchjob716@gmail.com', 'SearchJob');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperación de Contrasenaña';
        $mail->Body    = 'Hola! Esta es tu nueva contraseña: '.$nueva.'<br>'.'Puedes logearte con ella y modificarla por la que tu desees';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script> alert("Contraseña cambiada, te hemos enviando un correo con tu nueva contraseña"); window.location="login.php"; </script>';

    } catch (Exception $e) {
        echo "Hubo un error: {$mail->ErrorInfo}";
    }