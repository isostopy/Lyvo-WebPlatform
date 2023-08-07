<?php

   // Datos.
   require '../includes/config.php';

   // Funcionalidades comunes.
   require '../includes/functions.php';

   // Mensajes de error.
   require '../includes/error_messages.php';

   // -------------------------------------------------------------------------------------

   // Si el usuario ya está en la sesión,
   if(isset($_SESSION['userData'])) 
   {
      LoadPage("public/login_form.php");
   }

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Welcome</title>

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

        <div id="textos-inferiores">

            <div id="copyright">
                <p>Copyright 2023© All rights reserved</p>
            </div>

            <div id="botones-esquina">
                <div id="politica-privacidad">
                    <a href="#">Política de privacidad</a>
                </div>

                <div id="cookies">
                    <a href="#">Aviso de cookies</a>
                </div>
            </div>
        </div>

    </div>


</body>

</html>