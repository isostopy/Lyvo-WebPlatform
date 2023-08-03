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
         <h3>NUEVA CONTRASEÑA</h3>

         <input type="password" name="newpass" required placeholder="Contraseña">

         <?php
            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         ?>

         <input type="submit" name="submit" value="CAMBIAR" class="form-btn">

      </form>

   </div>

   </body>
</html>