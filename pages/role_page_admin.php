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
            <!-- En este caso solo va a parecer en el responsive -->
            <img id="logo" class="hide-widescreen" src="../assets/images/t_logo_lyvo_white.png" alt="Lyvo">
            
        </div>

        <!-- PANELS -->
        <div id="panels">

            <div id="panel-left">

                <div id="hoja-livo"></div>

                <div class="content">

                <h1 class="text-color-white">Ventana de administración</h1>

                <p class="text-color-white">Por favor, elige el modo de gestión.</p>

                <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_users.php' ">GESTIÓN DE USUARIOS</button>
                <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_places.php' ">GESTIÓN DE ESPACIOS</button>
                
                </div>

            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>

</body>

</html>