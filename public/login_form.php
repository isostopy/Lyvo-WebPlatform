<?php

   // Datos.
   require '../includes/config.php';

   // Funcionalidades comunes.
   require '../includes/functions.php';

   // -------------------------------------------------------------------------------------
   if(isset($_POST['submit']))
   {
      try
      {
         // Login.
         $token = Authenticate($_POST['email'], $_POST['password']);

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

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>login form</title>

      <!-- custom css file link  -->
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