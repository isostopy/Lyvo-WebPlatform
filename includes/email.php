<?php

    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    function SendEmail($mailTo, $subject, $body, $bodyNonHTML)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuraciones del servidor
            //$mail->SMTPDebug = 2;    
            $mail->isSMTP();                                      // Configura el remitente para usar SMTP
            $mail->Host       = 'smtp.gmail.com';                 // Especifica los servidores SMTP principales y de respaldo
            $mail->SMTPAuth   = true;                             // Habilita la autenticación SMTP
            $mail->Username   = 'isostopysmtptest@gmail.com';     // Nombre de usuario SMTP
            $mail->Password   = 'ibyoonpomvbyqglb';               // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Habilita el cifrado TLS; `PHPMailer::ENCRYPTION_SMTPS` también aceptado
            $mail->Port       = 587;                              // Puerto TCP al que se conecta

    
            // Recipientes
            $mail->setFrom('isostopysmtptest@gmail.com', 'Lyvo');
            $mail->addAddress($mailTo);     // Añade un destinatario
    
            // Contenido
            $mail->isHTML(true);                                  // Establece el formato de correo electrónico en HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $bodyNonHTML;
    
            $mail->send();

        } catch (Exception $e) {
    
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
        }
    }
?>