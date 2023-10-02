<?php

    // 1. REQUISITOS

    // Datos.
    require_once '../includes/config.php';

    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // Mensajes.
    require_once '../includes/messages.php';

    // -------------------------------------------------------------------------------------

    // 2. COMPROBAR SESIÓN

    // Comprobar la sesión. Si el usuario tiene sesión iniciada enviar directamente a la página de login.
    // La página de Login comprueba si hay sesión iniciada y gestiona al usuario.
    if(isset($_SESSION['userData'])) 
    {
        LoadPage("public/login_form.php");
    }

?>


<!-- ////////// HTML HTML HTML ////////// -->

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Welcome</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

</head>

<!-- Fondo oscuro para responsive -->
<body style="background-color: var(--color_2);">

    <div class="video-background">
        <video autoplay loop muted><source src="../assets/video/video_background.webm" type="video/webm">Recurso no soportado.</video>
    </div>


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

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left">

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">¡Bienvenido!</h1>
                    </div>   

                    <div class="margin-bottom-20px"></div>

                    <!-- Subpaneles -->
                    <div class="panel-subpanels-container">

                        <div class="panel-sub flex-column">

                            <p class="text-color-white">Por favor, elige el modo de acceso a la plataforma. Si no tienes usuario puedes crear uno nuevo o entrar como invitado.</p>
                            <div class="margin-bottom-20px"></div>
                            <button class ="button-general button-color" id="enter-button" onclick="location.href = 'login_form.php' ">Tengo cuenta</button>
                            <div class="margin-bottom-20px"></div>
                            <button class="button-general button-white" onclick="location.href = 'register_form.php' ">Crear cuenta</button>
                            <div class="margin-bottom-40px"></div>
                            <button class="button-general button-white" onclick="location.href = 'avatar.php' ">Entrar como invitado</button>
                            <div class="margin-bottom-5px"></div>
                            <p class="element-info text-color-white">No es necesario registro</p>

                        </div>

                    </div>

                </div>

                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right">

                <div class="panel-sub">

                    <img src="../assets/images/t_logo_lyvo_white.png" alt="Lyvo" class="img-center">

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

</body>

</html>