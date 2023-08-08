<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   if(isset($_POST['submit']))
   {
      try
      {
         if (!isset($_POST['terms'])) 
         {
            throw new Exception("Debe aceptar los términos y condiciones.");
         }

         // Login.
         Register($_POST['name'], $_POST['surname'],$_POST['email'],$_POST['password']);

         // Registro completo.
         LoadPage("pages/register_congrats.php");
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
   <title>Lyvo Registro</title>

   <link rel="stylesheet" href="../assets/css/lyvo_style.css">
   <link rel="stylesheet" href="../assets/css/register_form.css">

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

            <h1>Crear cuenta</h1>

            <form action="" method="post">

               <div class="margin-bottom-30px">

                  <div class="content-main">

                     <div class="content-label">
                        <h2>Nombre</h2>

                        <div class="input-icon">
                           <i class="fa fa-check icon-input" id="name-check-icon" style="visibility:hidden;"></i>
                           <input id="name-input" type="text" name="name" required>

                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Apellido</h2>

                        <div class="input-icon">
                           <i class="fa fa-check icon-input" id="surname-check-icon" style="visibility:hidden;"></i>
                           <input id="surname-input" type="text" name="surname" required>
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>E-mail</h2>

                        <div class="input-icon">
                           <i class="fa fa-check icon-input" id="email-check-icon" style="visibility:hidden;"></i>
                           <input id="email-input" type="email" name="email" required>

                        </div>
                     </div>

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

                           <input id="pass-input" type="password" name="password" required>

                        </div>

                        <p class="caracteres-minimos">La contraseña debe tener al menos 6 caracteres</p>

                     </div>
                  </div>

                  <label class="input-label-circular">
                     <input class="input-field-label margin-right-5px" type="checkbox" id="terms" name="terms">
                     <p class="radio-text">He leído y acepto los <a href="terms_and_conditions.php">Términos y Condiciones de uso</a></p>
                  </label>


                  <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } ?>

               </div>

               <input id="entrar-button" type="submit" name="submit" value="CREAR CUENTA" class="form-btn">

            </form>

            <p class="texto-bajo-boton">¿Ya tienes una cuenta? <a href="login_form.php">ENTRAR</a></p>

         </div>

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

      <div id="right-panel">

      </div>

      <div id="hoja-livo-grande">

      </div>

   </div>

   <script>

      passDisplay_Load('pass-input','show-pass-icon','hide-pass-icon');
      
      fieldChecker_Load('name-input', 'name-check-icon', null, 6);
      fieldChecker_Load('surname-input', 'surname-check-icon', null, 6);
      fieldChecker_Load('email-input', 'email-check-icon', '@', 6);    
      fieldChecker_Load('pass-input', 'pass-check-icon', null, 6);
   
    </script>

</body>

</html>