<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Datos.
   require_once '../includes/config.php';

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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Pass</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
   
   <!-- CONTENEDOR PRINCIPAL -->
   <div id="content">

      <!-- HEADER -->
      <div id="header">

         <!-- LOGO -->
         <img id="logo" src="../assets/images/t_logo_lyvo_color.png" alt="Lyvo">

      </div>

      <!-- PANELS -->
      <div id="panels">

         <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

            <div class="panel-content max-width-300px">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">Cambiar / Recuperar contraseña</h1>
               </div> 

               <div class="margin-bottom-20px"></div>

               <p>Por favor, introduce un E-mail válido y enviaremos las instrucciones para modificar o recuperar tu contraseña.</p>

               <div class="margin-bottom-20px"></div>

               <!-- FORM -->
               <form action="" method="post">

                  <!-- Input field email -->
                  <div class="panel-element">
                     <h2 class="text-color-blue">E-mail</h2>
                     <div class="margin-bottom-5px"></div>

                     <div class="input-field-icon-container">
                        <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                        <input id="input-email" type="email" name="email" placeholder="e-mail" required>
                     </div>
                  </div>

                  
                  <div class="margin-bottom-20px"></div>

                  <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } ?>

                  <input type="submit" name="submit" value="Enviar" class="button-general button-color">

                  <div class="margin-bottom-10px"></div>

                  <p>¿Necesitas regresar al login? <a class="link link-bold" href="login_form.php">LOGIN</a></p>

               </form>

            </div>

            <div class="lyvo-leaf lyvo-leaf-solid"></div>

         </div>

         <!-- PANEL DERECHO -->
         <div id="panel-right">

            <img src="../assets/images/web-image-01.jpg" alt="Lyvo" class="img-fullsize">

         </div>

      </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Dark.php"; ?>

    </div>

</body>

</html>