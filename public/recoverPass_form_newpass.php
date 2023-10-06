<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Datos.
   require_once '../includes/config.php';

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
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lyvo Pass</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
   <link rel="stylesheet" href="../assets/css/style_lyvo.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <script src="../assets/js/input_field_utilities.js"></script>

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
         <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

            <div class="panel-content max-width-300px">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">Cambiar / Recuperar contraseña</h1>
               </div>   

               <div class="margin-bottom-20px"></div>

               <p class="margin-bottom-30px">Por favor, introduce la nueva contraseña.</p>

               <form action="" method="post">

                  <!-- Input field contraseña -->
                  <div class="panel-element">
                     <h2 class="text-color-blue">Contraseña</h2>
                     <div class="margin-bottom-5px"></div>

                     <div class="input-field-icon-container">
                        <i class="fa fa-check input-field-icon-icon margin-right-20px" id="icon-check-pass" style="visibility:hidden;"></i>
                        
                        <div id="icon-show-pass" class="hover-pointer" style="visibility:visible;">
                           <i class="fa fa-eye-slash input-field-icon-icon"></i>
                        </div>

                        <div id="icon-hide-pass" class="hover-pointer" style="visibility:hidden;">
                           <i class="fa fa-eye input-field-icon-icon"></i>
                        </div>
                        
                        <input id="input-pass" type="password" name="password" placeholder="contraseña" required>
                     </div>
                     
                     <div class="margin-bottom-5px"></div>
                     <p class="element-info-detail">La contraseña debe tener al menos 6 caracteres</p>
                  </div>
               
                  <div class="margin-bottom-20px"></div>

                  <?php if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; } ?>

                  <input type="submit" name="submit" value="Modificar" class="button-general button-color">

                  <div class="margin-bottom-10px"></div>

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

   <script>

      passDisplay_Load('input-pass','icon-show-pass','icon-hide-pass');
      fieldChecker_Load('input-pass', 'icon-check-pass', undefined, 6);
   
   </script>

</body>

</html>