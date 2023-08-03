<?php

    //*******************************************************************
    // PHP encargado de gestionar el envío de email con PHP mailer.
    //*******************************************************************

    // Importar clases de PHP Mailer.
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    // Enviar Email.
    function SendEmail($mailTo, $subject, $body, $bodyNonHTML)
    {
        $mail = new PHPMailer(true);

        try {

            // CONFIGURACIÓN DEL SERVIDOR DE CORREO

            //$mail->SMTPDebug = 2;
            
            // Configura el remitente para usar SMTP
            $mail->isSMTP();
            // Especifica los servidores SMTP principales y de respaldo                                      
            $mail->Host       = 'smtp.gmail.com';
            // Habilita la autenticación SMTP                 
            $mail->SMTPAuth   = true;
            // Nombre de usuario SMTP                             
            $mail->Username   = 'isostopysmtptest@gmail.com';
            // Contraseña SMTP     
            $mail->Password   = 'ibyoonpomvbyqglb';
            // Habilita el cifrado TLS; `PHPMailer::ENCRYPTION_SMTPS` también aceptado               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // Puerto TCP al que se conecta   
            $mail->Port       = 587;                              

    
            // Emisor
            $mail->setFrom('isostopysmtptest@gmail.com', 'Lyvo');

            // Añadir destinatario
            $mail->addAddress($mailTo);     
    
            // Contenido
            // Establece el formato de correo electrónico en HTML
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $bodyNonHTML;
    
            // Enviar.
            $mail->send();

        } catch (Exception $e) {
    
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
        }
    }
?>