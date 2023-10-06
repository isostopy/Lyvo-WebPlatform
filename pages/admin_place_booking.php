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
                // TO DO - Hacer que solo salgan las reservas con fecha posterior a la actual.

                // Mostrar la reservas.
                foreach ($infoBookings->bookings as $booking) 
                {

                    echo '<div class="panel-sub flex-column panel-background-white">';
                    // Nombre
                    echo '<h2 class="text-color-blue">'.$booking->userEmail.'</h2>';
                    echo '<div class="margin-bottom-5px"></div>';
                    echo '<div class="bar-horizontal"></div>';

                    echo '<div class="margin-bottom-10px"></div>';
                    echo '<ul class="list-general">';
                    echo '<li>';
                    echo '<p class="text-color-blue">'.$booking->userEmail.'</p>';
                    echo '</li>';
                    echo '<div class="margin-bottom-10px"></div>';
                    echo '<li>';
                    echo '<p class="text-color-blue"> Inicio: '.$booking->startDate.'</p>'; 
                    echo '</li>';
                    echo '<div class="margin-bottom-10px"></div>';
                    echo '<li>';
                    echo '<p class="text-color-blue"> Fin: '.$booking->endDate.'</p>';
                    echo '</li>';
                    echo '</ul>';

                    echo '<div class="margin-bottom-20px"></div>';

                    echo '<form action="" method="post">';
                    echo "<input type='hidden' name='booking-id' value='".$booking->bookingId."'>"; // Valor encerrado entre comillas
                    echo "<input type='submit' class='button-color' value='Eliminar reserva'>";
                    echo '</form>';

                    echo '<div class="margin-bottom-10px"></div>';
                    echo "</div>";

                    echo '<div class="margin-bottom-20px"></div>';


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

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="../assets/js/input_field_utilities.js"></script>

</head>

<!-- Fondo oscuro -->
<body style="background-color: var(--color_2);">

    <!-- CONTENEDOR PRINCIPAL -->
    <div id="content">

        <!-- HEADER -->
        <div id="header">

            <!-- LOGO -->
            <img id="logo" src="../assets/images/t_logo_lyvo_white.png" alt="Lyvo">
            
        </div>

        <!-- PANELS -->
        <div id="panels">

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left" class="width-60vw flex-align-center padding-left-50px">

                <div class="margin-bottom-10vh"></div> <!-- Margen header -->
                <div class="margin-bottom-10px"></div>

                <div class="panel-content width-100">

                    <!-- Título del panel -->
                    <div class="panel-title max-width-300px">
                        <h1 class="text-color-white">Administración de <?php echo $placeId; ?></h1>
                    </div>

                    <div class="margin-bottom-40px"></div>

                    <!-- Título información -->
                    <div class="panel-title max-width-300px">
                        <p class="text-color-white">Gestión de personalización del espacio por parte del usuario. Desde este panel puede invitar al usuario elegido para configurar el espacio.</p>
                    </div>

                    <div class="margin-bottom-20px"></div>

                    
                    <!-- Subpaneles -->
                    <div class="panel-subpanels-container">

                        <!-- PANEL DE CONTROLES -->
                            <div class="panel-sub flex-column max-width-300px">

                                <!-- FORM -->
                                <form action="" method="post">

                                    <!-- Input field nombre -->
                                    <div class="panel-element">
                                        <h2 class="text-color-white">Nombre de usuario</h2>
                                        <div class="margin-bottom-5px"></div>

                                        <div class="input-field-icon-container">

                                            <i class="fa fa-check input-field-icon-icon" id="icon-check-name" style="visibility:hidden;"></i>
                                            <input id="input-name" type="text" name="general-info-name" placeholder="nombre" required>

                                        </div>

                                    </div>

                                    <div class="margin-bottom-20px"></div>

                                    <!-- Input field email -->
                                    <div class="panel-element">
                                        <h2 class="text-color-white">E-mail del usuario</h2>
                                        <div class="margin-bottom-5px"></div>

                                        <div class="input-field-icon-container">

                                            <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                                            <input id="input-email" type="email" name="general-info-email" placeholder="e-mail" required>

                                        </div>

                                    </div>

                                    <div class="margin-bottom-20px"></div>

                                    <!-- Fecha inicio reserva -->
                                    <div class="panel-element">

                                        <h2 class="text-color-white">Fecha de inicio de reserva</h2>
                                        <div class="margin-bottom-5px"></div>

                                        <input type="date" name="info-dateStart" placeholder="Fecha inicio" required>

                                    </div>

                                    <div class="margin-bottom-20px"></div>

                                    <div class="panel-element">

                                        <h2 class="text-color-white">Fecha de fin de reserva</h2>
                                        <div class="margin-bottom-5px"></div>

                                        <input type="date" name="info-dateEnd" placeholder="Fecha fin" required>

                                    </div>

                                    <div class="margin-bottom-40px"></div>

                                    <!-- Errores -->
                                    <?php
                                        if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; echo '<div class="margin-bottom-20px"></div>'; }
                                    ?>

                                    <!-- Botón submit -->
                                    <input type="submit" name="submit" value="Asignar" class="button-general button-color">

                                    <div class="margin-bottom-20px"></div>

                                    <!-- Botón configurar espacio -->
                                    <button class="button-general button-white" onclick="location.href = 'editor_place.php?placeId=<?php echo urlencode($placeId);?>' ">Configurar espacio</button>

                                    <div class="margin-bottom-20px"></div>

                                    <!-- Enlace volver -->
                                    <div class="panel-sub flex-justify-center">
                                        <a class="text-color-white" href="admin_places.php">Volver</a>
                                    </div>

                                </form>

                            </div>

                        <!-- PANEL DE RESERVAS -->
                        <div class="panel-sub flex-column">

                            <h2 class="text-color-none">///</h2>
                            <div class="margin-bottom-5px"></div>

                            <div class="panel-subpanels-container flex-column overflow-scroll">

                                <!-- Reservas -->

                                <?php PrintBookings($placeId); ?>

                            </div>

                        </div>

                    </div>
                    
                </div>

                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <div id="panel-right">

                <img src="../assets/images/web-image-02.jpg" alt="Lyvo" class="img-fullsize">

            </div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

    <script>

        fieldChecker_Load('input-email', 'icon-check-email', ['@','.'], 6);

    </script>

</body>

</html>