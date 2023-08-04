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
            throw new Exception("Debes aceptar los términos y condiciones.");
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
         <h3>Crear cuenta</h3>

         <input type="text" name="name" required placeholder="Nombre">
         <input type="text" name="surname" required placeholder="Apellidos">
         <input type="email" name="email" required placeholder="E-mail">
         <input type="password" name="password" required placeholder="Contraseña">

         <div>
            <input type="checkbox" id="terms" name="terms">
            <label for="terms">He leído y acepto los <a href="terms_and_conditions.php">Términos y Condiciones de uso</a></label>
         </div>

         <?php
            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         ?>

         <input type="submit" name="submit" value="CREAR CUENTA" class="form-btn">

         <p>¿Ya tienes una cuenta? <a href="login_form.php">ENTRAR</a></p>
      </form>

   </div>

   </body>
</html>
-->

<!DOCTYPE html>
<html>

<head>
   
   <link rel="stylesheet" href="../assets/css/lyvo_style.css">
   <link rel="stylesheet" href="../assets/css/register_form.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/register_form.js"></script>

</head>

<body>
   <div class="main-container">

      <div id="lyvo-logo">
         <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
      </div>

      <div id="left-panel">

         <div id="hoja-livo"></div>

         <div class="content">

            <form action="" method="post">

               <h1>Crear cuenta</h1>

               <div class="content-main">

                  <div class="content-label">
                     <h2>Nombre</h2>

                     <div class="input-icono">
                        <i class="fa fa-check icon-left" id="nombre-check-icon"></i>
                        <input id="nombre-input" type="text" name="name" required>


                     </div>
                  </div>

                  <div class="content-label">
                     <h2>Apellido</h2>

                     <div class="input-icono">
                        <i class="fa fa-check icon-left" id="apellido-check-icon"></i>
                        <input id="apellido-input" type="text" name="surname" required>
                     </div>
                  </div>



                  <div class="content-label">
                     <h2>E-mail</h2>

                     <div class="input-icono">
                        <i class="fa fa-check icon" id="email-check-icon"></i>
                        <input id="email-input" type="email" name="email" required>

                     </div>
                  </div>

                  <div class="content-label">
                     <h2>Contraseña</h2>

                     <div class="input-icono">
                        <i class="fa fa-check icon" id="contraseña-check-icon"></i>

                        <div id="eye-icon" onclick="mostrarContrasena()">
                           <i class="fa fa-eye " id="ver-contraseña-icon"></i>
                        </div>

                        <div id="eye-icon-slash" onclick="mostrarContrasena()">
                           <i class="fa fa-eye-slash" id="ocultar-contraseña-icon"></i>
                        </div>

                        <input id="contraseña-input" type="password" name="password" required>
                     </div>

                     <p id="caracteres-minimos">La contraseña debe tener al menos 6 caracteres</p>

                  </div>
               </div>

               <input type="checkbox" id="terms" name="terms">
               <label id="terminos" for="terms"><p>He leído y acepto los <a href="terms_and_conditions.php">Términos y Condiciones de uso</a></p></label>


               <?php

                  if (isset($error)) {
                     echo '<span class="error-msg">' . $error . '</span>';
                  }
                  
               ?>

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

</body>

</html>