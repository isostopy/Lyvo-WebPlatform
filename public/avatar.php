<?php
   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   $userRegistered = false;

   // Comprobar si el usuario ya ha seleccionado un avatar.
   if(isset($_SESSION['userData'])) 
   {
      $userRegistered = true;

      // Si el usuario está registrado y tiene un avatar, enviar al formulario médico.
      if(isset($_SESSION['userData']->data->AvatarInformation->type)) 
      {
         // Almacenamos la identificación del avatar en la sesión para utilizarlo después.
         $_SESSION['avatarSelected'] = $_SESSION['userData']->data->AvatarInformation->type;
         LoadPage("pages/medicalInformation_launcher.php");
      }
   }

   // Continuamos si el usuario no tiene avatar, esté registrado o no.
   // -------------------------------------------------------------------------------------
   if($_POST)
   {
      // Obtener el valor del avatar seleccionado
      $avatarSelected = array_keys($_POST)[0];

      // Almacenamos la identificación del avatar en la sesión para utilizarlo después.
      $_SESSION['avatarSelected'] = $avatarSelected;

      // Si el usuario ha hecho login, guardar en el CMS el avatar seleccionado.
      if($userRegistered)
      {
         try
         {
            UserAvatarSave($avatarSelected);

            // Si el avatar está registrado tenemos que comprobar primero la historia médica.
            LoadPage("pages/medicalInformation_launcher.php");
         }
         catch (Exception $e)
         {
            $error = $e->getMessage();
         }
      }

      // Si el usuario no está registrado pasamos directamente a la página de Lyvo.
      LoadPage("public/3D_launcher.php");
   }
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
         <h3>Selecciona tu avatar</h3>

         <input type="submit" name="avatar1" value="AVATAR 1" class="form-btn">
         <input type="submit" name="avatar2" value="AVATAR 2" class="form-btn">
         <input type="submit" name="avatar3" value="AVATAR 3" class="form-btn">
         <input type="submit" name="avatar4" value="AVATAR 4" class="form-btn">
         <input type="submit" name="avatar5" value="AVATAR 5" class="form-btn">
         <input type="submit" name="avatar6" value="AVATAR 6" class="form-btn">

         <?php

            if(isset($_SESSION['userData']))
            {
               echo '<a href="../pages/logout.php" class="btn">logout</a>';
            }
            else
            {
               echo '<p>¿Ya tienes una cuenta? <a href="login_form.php">ENTRAR</a></p>';
            }

         ?>

         <?php

            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }

         ?>

      </form>

   </div>

   </body>
</html>