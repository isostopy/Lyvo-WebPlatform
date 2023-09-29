<?php
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   // Datos.
   require_once '../includes/config.php';

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
      // Almacenamos la identificación del avatar en la sesión para utilizarlo después.
      $avatarSelected = $_POST['avatar-selected'];

      $_SESSION['avatarSelected'] = $avatarSelected;

      // Almacenamos el nombre del usuario.
      $_SESSION['nameSelected'] = $_POST['input-name'];

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
      LoadPage("public/3d_launcher.php");
   }
?>

<!DOCTYPE html>
<html>

   <head>

   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Login</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
    
    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="../assets/js/avatar.js"></script>

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

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left">

               <div class="panel-content max-width-400px">

                  <!-- Título del panel -->
                  <div class="panel-title">
                     <h1 class="text-color-blue">Selección de avatar</h1>
                  </div>   

                  <div class="margin-bottom-40px"></div>

                  <!-- FORM -->
                  <form action="" method="post">

                     <div class="panel-subpanels-container">

                        <div class="panel-sub flex-column">
                           
                           <?php

                              // Mostrar campo para añadir nombre si el usuario no está registrado

                              if(!isset($_SESSION['userData']))
                              {
                                 echo
                                 '
                                 <div class="panel-element">
                                    <h2 class="text-color-blue">Nombre</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <input id="input-name" type="text" name="name" placeholder="Nombre" required>
                                    </div>
                                 </div>

                                 <div class="margin-bottom-20px"></div>
                                 ';
                              }

                           ?>
                        
                           <h2 class="text-color-blue">Avatar</h2>

                           <p>Elige entre una selección de avatares predefinidos.</p>
                           <div class="margin-bottom-20px"></div>


                           <?php

                              // Mostrar opciones para crear una cuenta o hacer logout.
                              if(!isset($_SESSION['userData']))
                              {
                                 echo '<p>¿Quieres más opciones de personalización?</p><a class="link link-bold" href="register_form.php"><p>CREA UNA CUENTA</p></a><div class="margin-bottom-20px"></div>
                                 ';   
                              }
                              else
                              {
                                 echo '<a href="../pages/logout.php" class="link link-bold">Logout</a>';
                              }

                           ?>

                           <div class="panel-sub flex-center flex-margin-r10-c20">

                              <div class="avatar-button" id="avatar-1"> <img src="../assets/images/t_icon_man_1.png"> </div>
                              <div class="avatar-button" id="avatar-2"> <img src="../assets/images/t_icon_woman_2.png"> </div>
                              <div class="avatar-button" id="avatar-3"> <img src="../assets/images/t_icon_woman_3.png"> </div>
                              <div class="avatar-button" id="avatar-4"> <img src="../assets/images/t_icon_man_3.png"> </div>
                              <div class="avatar-button" id="avatar-5"> <img src="../assets/images/t_icon_woman_1.png"> </div>
                              <div class="avatar-button" id="avatar-6"> <img src="../assets/images/t_icon_man_2.png"> </div>

                              <input type="hidden" value="avatar-1" name='avatar-selected' id='avatar-selected'>

                           </div>

                        </div>

                     </div>

                     <div class="margin-bottom-40px"></div>

                     <input type="submit" value="ENTRAR" class="button-general button-color" id="button-avatar-submit">

                     <div class="margin-bottom-40px"></div>

                  </form>

               </div>

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