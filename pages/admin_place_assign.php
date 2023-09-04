<?php

   // Datos.
   require_once '../includes/config.php';
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   // Mensajes.
   require_once '../includes/messages.php';
   // Reservas.
   require_once '../3d-custom/booking.php';
   
   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession();

   // ACCIONES INICIALES. OBTENER ESPACIO. -------------------------------------------------------------
   $placeId;

   // Obtenemos el valor del espacio de la URL y lo decodificamos.
   if (isset($_GET['id'])) 
   {
        $placeId = urldecode($_GET['id']);

        // Es importante comprobar y sanear el varlor en la URL.
        if (!in_array($placeId, [Places::AUDITORIO->value, Places::SALAEXPOSICIONES->value, Places::SALAPRIVADA->value])) 
        {
            $placeId = Message_Error_PlaceSelected();
        }
   }

   // Si el espacio no existe.
   else
   {
        $placeId = Message_Error_PlaceSelected();
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

            $booking->place = $placeId;
            $booking->userId = $userId;
            $booking->userEmail = $email;
            $booking->dateStart = $dateStart;
            $booking->dateEnd = $dateEnd;

            // Una vez tenemos todos los datos, hay que almacenar la reserva.
            StoreBooking($booking);

        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
   } 

   // 4. Enviar email de invitación.

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

                    <button class="button-general margin-top-30px" onclick="location.href = 'place_configurator.php' ">CONFIGURAR ESPACIO</button>

                </form>
               
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