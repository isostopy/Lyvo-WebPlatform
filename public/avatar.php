<?php
   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   $userRegistered = false;

   $fromMetaverse = false;

   // Comprobar si el usuario vuelve desde el metaverso, para no saltar si tiene sesión iniciada.
   if (isset($_GET['fromMetaverse'])) 
   {
      $fromMetaverse = true;
   }

   // Comprobar si el usuario ya ha seleccionado un avatar.
   if(isset($_SESSION['userData'])) 
   {
      $userRegistered = true;

      // Si el usuario está registrado y tiene un avatar, enviar al formulario médico.
      if(isset($_SESSION['userData']->data->AvatarInformation->type)) 
      {
         // Almacenamos la identificación del avatar en la sesión para utilizarlo después.
         $_SESSION['avatarSelected'] = $_SESSION['userData']->data->AvatarInformation->type;

         // Guardar los datos en JS para mostrarlos.
         $avatar = $_SESSION['avatarSelected'];
         echo '<script type="text/javascript">localStorage.setItem("avatar","'.$avatar.'");</script>';

         // Comprobamos que no viene del 3D.
         if(!$fromMetaverse)
         {
            // Cargamos la página de la información médica.
            LoadPage("pages/medicalInformation_launcher.php");
         } 
      }
      // Si no hay avatar en la sesión de PHP, nos aseguramos de eliminar del almacenamiento local si hay algún avatar guardado.
      else
      {
         echo '<script type="text/javascript">localStorage.setItem("avatar","");</script>';
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
-->

<!DOCTYPE html>
<html>

   <head>

      <link rel="stylesheet" href="../assets/css/lyvo_style.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="../assets/js/avatar.js"></script>

   </head>

   <body>

      <div class="main-container">

         <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
         </div>

         <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

               <h1>¡Bienvenido!</h1>

               <?php

                  // Mostrar campo para añadir nombre si el usuario no está registrado
                  if(!isset($_SESSION['userData']))
                  {
                     echo '<div class="content-label"> <h2>Nombre</h2><div class="input-icono"> <i class="fa fa-check icon" id="check-icon"> </i><input class="input-field" id="name-input" type="text"> </div> </div>';
                  }

               ?>

                  <form action="" method="post">

                     <div class="content-label">
                        
                        <h2>Avatar</h2>

                        <p>Elige entre una selección de avatares predefinidos.</p>

                        <?php

                           // Mostrar opciones para crear una cuenta o hacer logout.
                           if(!isset($_SESSION['userData']))
                           {
                              echo '<p>¿Quieres más opciones de personalización?</p><a href="register_form.php"><p>CREA UNA CUENTA</p></a>';   
                           }
                           else
                           {
                              echo '<a href="../pages/logout.php"><p>logout</p></a>';
                           }

                        ?>

                        <div class="avatar-button-container">

                              <div class="avatar-button" id="avatar_1">
                                 <img src="../assets/images/t_icon_man_1.png">
                              </div>

                              <div class="avatar-button" id="avatar_2">
                                 <img src="../assets/images/t_icon_woman_2.png">
                              </div>

                              <div class="avatar-button" id="avatar_3">
                                 <img src="../assets/images/t_icon_woman_3.png">
                              </div>

                              <div class="avatar-button" id="avatar_4">
                                 <img src="../assets/images/t_icon_man_3.png">
                              </div>

                              <div class="avatar-button" id="avatar_5">
                                 <img src="../assets/images/t_icon_woman_1.png">
                              </div>

                              <div class="avatar-button" id="avatar_6">
                                 <img src="../assets/images/t_icon_man_2.png">
                              </div>

                        </div>

                     </div>

                     <input type="submit" name="avatar1" value="ENTRAR" class="button-general" id="button-avatar-submit">

                  </form>

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

         <div id="right-panel"></div>

         <div id="hoja-livo-grande"></div>

      </div>

   </body>

</html>