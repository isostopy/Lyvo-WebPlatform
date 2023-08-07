<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   $paramToken = isset($_GET['token']) ? $_GET['token'] : null;

   if(isset($_POST['submit']))
   {
      try
      {
         // Set.
         UserRecoverPassSet($paramToken,$_POST['newpass']);

         // Registro completo.
         LoadPage("public/login_form.php");
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
         <h3>NUEVA CONTRASEÑA</h3>

         <input type="password" name="newpass" required placeholder="Contraseña">

         <input type="submit" name="submit" value="CAMBIAR" class="form-btn">

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
   <title>Lyvo Login</title>

   <link rel="stylesheet" href="../assets/css/lyvo_style.css">

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

               <h1>Cambiar / Recuperar contraseña</h1>

               <p class="margin-bottom-30px">Por favor, introduce la nueva contraseña.</p>

               <form action="" method="post">

               <div class="content-label">

                  <h2>Contraseña</h2>

                  <div class="input-icon">
                     <i class="fa fa-check icon-input icon-input-margin-right" id="pass-check-icon" style="visibility:hidden;"></i>

                     <div id="show-pass-icon" class="hover-pointer" style="visibility:visible;">
                        <i class="fa fa-eye-slash icon-input"></i>
                     </div>

                     <div id="hide-pass-icon" class="hover-pointer" style="visibility:hidden;">
                        <i class="fa fa-eye icon-input"></i>
                     </div>

                     <input id="pass-input" type="password" name="newpass" required>

                  </div>

                  <p class = "caracteres-minimos">La contraseña debe tener al menos 6 caracteres</p>

               </div>

               <?php if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; } ?>

               <input type="submit" name="submit" value="CAMBIAR" >

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

   <script>

   passDisplay_Load('pass-input','show-pass-icon','hide-pass-icon');
   fieldChecker_Load('pass-input', 'pass-check-icon', null, 6);
   
   </script>

</body>

</html>