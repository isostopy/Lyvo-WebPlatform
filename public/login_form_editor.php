<?php

   // Datos.
   require_once '../includes/config.php';

   // Funcionalidades comunes.
   require_once '../includes/functions.php';

   // Mensajes.
   require_once '../includes/messages.php';

   
   // -------------------------------------------------------------------------------------
   if(isset($_POST['submit']))
   {
        try
        {
            $email = $_POST['email'];

            // Login.
            Authenticate($email, $_POST['password']);

            // Obtener información del Usuario.
            UserGetData();

            // Redirigir al usuario a la página de edición.
            LoadPage("pages/editor_main.php");
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
    <title>Lyvo Login</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
    <link rel="stylesheet" href="../assets/css/lyvo_style.css">
    <link rel="stylesheet" href="../assets/css/login_form.css">

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

                <h1>Acceso al configurador de espacios</h1>

                <form action="" method="post">

                    <div class="margin-bottom-30px">

                        <div class="content-label">

                            <h2>E-mail</h2>

                            <div class="input-icon">
                                <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"> </i>
                                <input id="email-input" type="email" name="email" required>
                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Contraseña <a href="recoverPass_form_email.php" id="recover-pass">¿Has olvidado tu contraseña?</a></h2>

                            <div class="input-icon">

                            <div id="show-pass-icon" class="hover-pointer" style="visibility:visible;">
                                <i class="fa fa-eye-slash icon-input"></i>
                            </div>

                            <div id="hide-pass-icon" class="hover-pointer" style="visibility:hidden;">
                                <i class="fa fa-eye icon-input"></i>
                            </div>
                                <input id="pass-input" type="password" name="password" required>
                            </div>

                        </div>

                        <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } ?>

                    </div>

                    <input type="submit" name="submit" value="ACCEDER AL CONFIGURADOR" >

                </form>

            </div>

        </div>

        <div id="right-panel">
        </div>

        <div id="hoja-livo-grande">
        </div>

        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>

    <script>

        fieldChecker_Load('email-input', 'email-check-icon', ['@','.'], 6);
        passDisplay_Load('pass-input','show-pass-icon','hide-pass-icon');
    
    </script>

</body>

</html>