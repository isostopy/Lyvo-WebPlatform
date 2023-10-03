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
    <title>Lyvo Admin</title>
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
            <div id="panel-left">

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Panel de administrador</h1>
                    </div>   

                    <div class="margin-bottom-20px"></div>

                    <!-- Subpaneles -->
                    <div class="panel-subpanels-container">

                        <div class="panel-sub flex-column">

                            <p class="text-color-white">Por favor, elija qué quiere gestionar a continuación.</p>
                            <div class="margin-bottom-20px"></div>
                            <button class ="button-general button-color" onclick="location.href = 'admin_users.php' ">Gestión de usuarios</button>
                            <div class="margin-bottom-20px"></div>
                            <button class ="button-general button-color" onclick="location.href = 'admin_places.php' ">Gestión de espacios</button>
                        
                        </div>

                    </div>

                </div>

                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right"></div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

</body>

</html>