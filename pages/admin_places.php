<?php

   // Datos.
   require_once '../includes/config.php';
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession(UserType::ADMINISTRATOR->value);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Usuarios</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

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
            <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Administración de espacios</h1>
                    </div> 

                    <div class="margin-bottom-20px"></div>

                    <p class="text-color-white">Por favor, elige un espacio para configurar.</p>

                    <div class="margin-bottom-20px"></div>

                    <!-- Espacios -->
                    <div class="panel-sub flex-column panel-background-white">

                        <ul class="list-general">
            
                            <div class="margin-bottom-10px"></div>
                            <li>
                                <a class="link link-text text-color-blue" href="admin_place_booking.php?placeId=<?php echo Places::AUDITORIO->value; ?>">Auditorio Lyvo</a>
                            </li>
                            <div class="margin-bottom-20px"></div>

                            <li>
                                <a class="link link-text text-color-blue" href="admin_place_booking.php?placeId=<?php echo Places::EXPOSICIONES->value; ?>">Sala de Exposiciones Lyvo</a>
                            </li>
                            <div class="margin-bottom-20px"></div>

                            <li>
                                <a class="link link-text text-color-blue" href="admin_place_booking.php?placeId=<?php echo Places::SALAPRIVADA->value; ?>">Sala privada</a>
                            </li>
                            <div class="margin-bottom-20px"></div>

                            <li>
                                <a class="link link-text text-color-blue">Auditorio iFertility (desarrollo)</a>
                            </li>
                            <div class="margin-bottom-20px"></div>
            
                        </ul>

                    </div>

                    <div class="margin-bottom-30px"></div>

                    <!-- Enlace volver -->
                    <div class="panel-sub flex-justify-center">
                        <a class="text-color-white" href="role_page_admin.php">Volver</a>
                    </div>

                </div>

                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right">

                <img src="../assets/images/web-image-02.jpg" alt="Lyvo" class="img-fullsize">

            </div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

</body>

</html>