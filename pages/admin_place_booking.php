<?php

   // Datos.
   require_once '../includes/config.php';
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   // Mensajes.
   require_once '../includes/messages.php';
   // Bookings.
   require_once '../includes/booking.php';
   // Email.
   require_once '../includes/email.php';
   
   // Comprobar que el usuario tiene sesión iniciada y que el usuario es administrador.
   UserCheckSession(UserType::ADMINISTRATOR->value);

   // ACCIONES INICIALES. OBTENER ESPACIO. -------------------------------------------------------------
   
   // Obtenemos el valor del espacio de la URL y lo decodificamos.
   $placeId = PlaceGetFromURL();

   // ACCIONES PARA MOSTRAR LAS RESERVAS ACTUALES -------------------------------------------------------
   function PrintBookings($place)
   {
        // Comprobamos que tenemos un valor de lugar.
        if($place)
        {
            // Obtener la información.
            $infoBookings = BookingGetByPlace($place);

            // Si no hay archivo de reservas, volvemos.
            if (is_object($infoBookings) && isset($infoBookings->bookings))
            {
                // Mostrar la reservas.
                foreach ($infoBookings->bookings as $booking) 
                {
                // HACER QUE SOLO SALGAN LAS RESERVAS CON CITAS POSTERIORES
                echo "<div>";
                echo "<p>".$booking->userEmail."</p>";
                echo "<p> Inicio: ".$booking->startDate."</p>"; 
                echo "<p> Fin: ".$booking->endDate."</p>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='booking-id' value='".$booking->bookingId."'>"; // Valor encerrado entre comillas
                echo "<input type='submit' value='Eliminar reserva'>";
                echo "</form>";
                echo "</div>";
                echo "<br>";
                }
            }      
        }

        // Si no hay valor de lugar, indicar el error.
        else
        {
            echo "<p>".Message_Error_BookingGet()."</p>";
        }
   }

   // ACCIONES PARA ELIMINAR RESERVAS -------------------------------------------------------------------
   if(isset($_POST['booking-id']))
   {
        $bookingId = $_POST['booking-id'];
        BookingDelete($placeId, $bookingId);
   }

   // ACCIONES DE CONFIGURACIÓN. ------------------------------------------------------------------------
   if (isset($_POST['general-info-email']))
   {
        $email = $_POST['general-info-email'];
        $dateStart = $_POST['info-dateStart'];
        $dateEnd = $_POST['info-dateEnd'];

        try
        {
            // 1. Comprobar que el usuario existe.
            if(!UserCheckExistenceByEmail($email))
            {
                throw new Exception(Message_Error_UserNotRegistered());
            }

            // 2. Comprobar que la fecha de inicio es anterior a la de final.
            // Convertir las fechas a objetos DateTime para compararlas
            $start = new DateTime($dateStart);
            $end = new DateTime($dateEnd);

            if($start >= $end)
            {
                throw new Exception(Message_Error_Dates());
            }

            // 3. Realizar la reserva.
            // Obtener el id del usuario. Recordemos que antes hemos comprobado
            // que el email existe.
            $userId = UserGetDataByEmail($email)->id;

            // Almacenar la información en un stdClass;
            $booking = new stdClass();

            $booking->bookingId = uniqid();
            $booking->place = $placeId;
            $booking->userId = $userId;
            $booking->userEmail = $email;
            $booking->dateStart = $dateStart;
            $booking->dateEnd = $dateEnd;

            // Una vez tenemos todos los datos, hay que almacenar la reserva.
            BookingStore($booking);

            // 4. finalmente informamos al usuario.
            $subject = Email_Bookings_Subject();
            $body = Email_Bookings_Body($placeId, $dateStart, $dateEnd, $GLOBALS['URL_LoginEditor']);
            $bodyNonHTML = Email_Bookings_BodyNonHtml($placeId, $dateStart, $dateEnd, $GLOBALS['URL_LoginEditor']);

            SendEmail($email, $subject, $body, $bodyNonHTML);

            // Terminar en otra página.
            LoadPage("pages/admin_place_booking_congrats.php");
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
   } 
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Config</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/lyvo_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../assets/js/input_field_utilities.js"></script>

</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

               <h1>Administración de <?php echo $placeId; ?></h1>

               <p class="margin-bottom-30px">Gestión de personalización del espacio por parte del usuario. Desde este panel puede invitar al usuario elegido para configurar el espacio.</p>

                <form id="userForm" action="" method="post">

                    <div class="content-label">

                        <h2>Email del usuario</h2>

                        <div class="input-icon">

                        <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                        <input id="email-input" type="text" name="general-info-email" placeholder="E-mail" required>

                        </div>

                    </div>

                    <div class="content-label">

                        <h2>Fecha de inicio del permiso de configuración.</h2>

                        <div class="input-icon">

                        <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                        <input type="date" name="info-dateStart" placeholder="Fecha inicio" required>

                        </div>

                    </div>

                    <div class="content-label">

                        <h2>Fecha de fin del permiso de configuración.</h2>

                        <div class="input-icon">

                        <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                        <input type="date" name="info-dateEnd" placeholder="Fecha fin" required>

                        </div>

                    </div>

                    <?php
                        if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }
                    ?>
                    
                    <input type="submit" name="submit" value="ASIGNAR" class="form-btn margin-bottom-50px">

                </form>

                <button class="button-general margin-bottom-30px" onclick="location.href = 'editor_place.php?placeId=<?php echo urlencode($placeId);?>' ">CONFIGURAR ESPACIO</button>

                <div if="bookingsInfo">
                    
                    <?php PrintBookings($placeId) ?>

                </div>
            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <div id="textos-inferiores">

            <div id="copyright">
                <p>Copyright 2023© All rights reserved</p>
            </div>

            <div id="botones-esquina">
                <div id="politica-privacidad">
                    <a href="../public/privacy.html">Política de privacidad</a>
                </div>

                <div id="cookies">
                    <a href="../public/privacy.html">Aviso de cookies</a>
                </div>
            </div>
        </div>

    </div>

    <script>

        fieldChecker_Load('email-input', 'email-check-icon', ['@','.'], 6);



    </script>

</body>

</html>