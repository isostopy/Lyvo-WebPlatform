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

    <link rel="stylesheet" href="../assets/css/lyvo_style.css">

</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

                <h1>¡Bienvenido!</h1>

                <p>Por favor, elige el modo de acceso a la plataforma. Si no tienes usuario puedes crear uno nuevo o entrar como invitado.</p>

                <button class ="button-general margin-top-bottom-10px" id="enter-button" onclick="location.href = 'login_form.php' ">TENGO CUENTA</button>
                <button class="button-general button-border margin-top-bottom-10px" onclick="location.href = 'register_form.php' ">CREAR CUENTA</button>
                <button class="button-general button-border margin-top-50px" onclick="location.href = 'avatar.php' ">ENTRAR COMO INVITADO</button>

                <p class="caracteres-minimos">No es necesario registro</p>

            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>

</body>

</html>