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

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>register form</title>

      <!-- custom css file link  -->
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