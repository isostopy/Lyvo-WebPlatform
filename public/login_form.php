<?php

   // Datos.
   require '../includes/config.php';

   // Funcionalidades comunes.
   require '../includes/functions.php';

   // Mensajes de error.
   require '../includes/error_messages.php';

   // -------------------------------------------------------------------------------------
   if(isset($_POST['submit']))
   {
        try
        {
            $email = $_POST['email'];

            // Login.
            $token = Authenticate($email, $_POST['password']);

            // Verificar si $token está definido
            if (!$token) { throw new Exception("No se ha podido realizar el Login."); }

            // Obtener información del Usuario.
            UserGetData($token);

            // Redirigir al usuario o mostrar alguna otra página aquí
            if (isset($_SESSION['userData']->data->role)) 
            {
                $userRole = $_SESSION['userData']->data->role;

                // Comprobar qué es lo que tiene el usuario, si ya tiene avatar, historia clínica, etc. y enviar ahí.
                LoadPageByUserRole($userRole);
            }
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
   }

?>

<!--
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>login form</title>

      <link rel="stylesheet" href="../assets/css/style.css">

   </head>
   <body>
      
   <div class="form-container">

      <form action="" method="post">
         <h3>ENTRAR</h3>

         <input type="email" name="email" required placeholder="E-mail">
         <input type="password" name="password" required placeholder="Contraseña">

         <?php
            if(isset($error))
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         ?>

         <input type="submit" name="submit" value="ENTRAR" class="form-btn">
         <p>¿Necesitas una cuenta? <a href="register_form.php">REGÍSTRATE</a></p>
         <a href="avatar.php">Continuar sin usuario</a>
         <br>
         <a href="recoverPass_form_email.php">He olvidado mi contraseña</a>
      </form>
   
   </div>
   
   </body>
</html>

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <link rel="stylesheet" href="../assets/css/lyvo_style.css">
    <link rel="stylesheet" href="../assets/css/login_form.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="../assets/js/login_form.js"></script>

</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

                <h1>Entrar</h1>

                <form action="" method="post">

                    <div class="content-label">

                        <h2>E-mail</h2>

                        <div class="input-icon">
                            <i class="fa fa-check icon" id="email-check-icon"></i>
                            <input id="email-input" type="email" name="email" required>
                        </div>

                    </div>

                    <div class="content-label">

                        <h2>Contraseña <a href="#" id="recuperar-contraseña">¿Has olvidado tu contraseña?</a></h2>

                        <div class="input-icon">
                            <i class="fa fa-check icon" id="contraseña-check-icon"></i>

                            <div id="eye-icon" onclick="mostrarContrasena()">
                                <i class="fa fa-eye " id="ver-contraseña-icon"></i>
                            </div>

                            <div id="eye-icon-slash" onclick="mostrarContrasena()">
                                <i class="fa fa-eye-slash" id="ocultar-contraseña-icon"></i>
                            </div>

                            <input id="contraseña-input" type="password" name="password" required>

                            <?php
                                if (isset($error)) {
                                    echo '<span class="error-msg">' . $error . '</span>';
                                }
                            ?>

                        </div>

                    </div>

                    <label id="recordarme"><input type="checkbox"> <p>Recordarme</p> </label>

                    <input id="entrar-button" type="submit" name="submit" value="ENTRAR" class="form-btn">

                    <p class="texto-bajo-boton">¿Necesitas una cuenta? <a href="register_form.php">REGISTRO</a></p>

                </form>

            </div>

        </div>

        <div id="right-panel">
        </div>

        <div id="hoja-livo-grande">
        </div>

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