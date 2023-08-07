<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   if(isset($_POST['submit']))
   {
      try
      {
         // Request.
         UserRecoverPassRequest($_POST['email']);

         // Registro completo.
         LoadPage("pages/recoverPass_congrats.php");
      }
      catch (Exception $e)
      {
         $error = $e->getMessage();
      }
   };

?>

<!--
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>register form</title>

      <link rel="stylesheet" href="../assets/css/style.css">

   </head>
   <body>
      
   <div class="form-container">

      <form action="" method="post">
         <h3>RECUPERAR CONTRASEÑA</h3>

         <input type="email" name="email" required placeholder="E-mail">

         <?php
            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         ?>

         <input type="submit" name="submit" value="RECUPERAR" class="form-btn">

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
    <title>Lyvo Recover</title>

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

               <h1>Cambiar / Recuperar contraseña</h1>

               <p class="margin-bottom-50px">Por favor, introduce un E-mail válido y enviaremos las instrucciones para modificar o recuperar tu contraseña.</p>

               <form action="" method="post">

                  <div class="content-label">

                     <h2>E-mail</h2>

                     <div class="input-icon">
                           <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"> </i>
                           <input id="email-input" type="email" name="email" required>
                     </div>

                  </div>

                  <?php

                     if (isset($error)) {
                        echo '<span class="error-msg">' . $error . '</span>';
                     }

                  ?>

                  <input type="submit" name="submit" value="RECUPERAR" >

                  <p class="texto-bajo-boton">¿Necesitas regresar al login? <a href="LOGIN_form.php">LOGIN</a></p>

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