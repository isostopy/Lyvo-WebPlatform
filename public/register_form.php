<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';

   // Datos.
   require_once '../includes/config.php';
   
   // Messages.
   require_once '../includes/messages.php';

   if(isset($_POST['submit']))
   {
      try
      {
         $pass = $_POST['password'];

         // Comprobar contraseña
         if (isset($_POST['password'])) 
         {
            if(strlen($pass)<6)
            {
               throw new Exception(Message_Error_PassRequirements());
            }           
         }

         // Comprobar términos y condiciones.
         if (!isset($_POST['terms'])) 
         {
            throw new Exception(Message_Error_TermsCondNo());
         }
   
         // Register.
         Register($_POST['name'], $_POST['surname'],$_POST['email'],$_POST['password'],UserType::CLIENT->value,UserStatus::INVITED->value,true);

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

            <div class="panel-content max-width-700px">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">Crear cuenta</h1>
               </div>   

               <div class="margin-bottom-40px"></div>

               <!-- FORM -->
               <form action="" method="post">

                  <div class="panel-subpanels-container">

                     <div class="panel-sub flex-wrap flex-margin-r20-c20 flex-spaceBetween">

                        <!-- Input field name -->
                        <div class="panel-element-adaptative">
                           <h2 class="text-color-blue">Nombre</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-name" style="visibility:hidden;"></i>
                              <input id="input-name" type="text" name="name" placeholder="nombre" required>
                           </div>
                           
                        </div>

                        <!-- Input field apellido -->
                        <div class="panel-element-adaptative">
                           <h2 class="text-color-blue">Apellidos</h2>
                           <div class="margin-bottom-5px"></div>
                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-surname" style="visibility:hidden;"></i>
                              <input id="input-surname" type="text" name="surname" placeholder="apellidos" required>
                           </div>
                        </div>

                        <!-- Input field email -->
                        <div class="panel-element-adaptative">
                           <h2 class="text-color-blue">E-mail</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                              <input id="input-email" type="email" name="email" placeholder="e-mail" required>
                           </div>
                        </div>

                        <!-- Input field contraseña -->
                        <div class="panel-element-adaptative">
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

                     </div>

                  </div>

                  <div class="margin-bottom-20px"></div>

                  <div class="panel-sub flex-row suboption">
                     <input class="margin-right-10px" type="checkbox" id="terms" name="terms">
                     <p>He leído y acepto los <a class="link link-bold" href="../public/privacy.html">Términos y Condiciones de uso</a></p>   
                  </div>

                  <div class="margin-bottom-40px"></div>

                  <!-- Respuestas -->
                  <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; echo '<div class="margin-bottom-10px"></div>';} ?>

                  <input id="button-create" type="submit" name="submit" value="Crear cuenta" class="button-general button-color">

               </form>

               <div class="margin-bottom-10px"></div>

               <div class="panel-sub suboption">
                  <p>¿Ya tienes una cuenta? <a class="link link-bold" href="login_form.php">ENTRAR</a></p>        
               </div>

               <div class="margin-bottom-20px"></div>
               
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
      
      fieldChecker_Load('input-name', 'icon-check-name', undefined, 1);
      fieldChecker_Load('input-surname', 'icon-check-surname', undefined, 1);
      fieldChecker_Load('input-email', 'icon-check-email', ['@','.'], 6);    
      fieldChecker_Load('input-pass', 'icon-check-pass', undefined, 6);
   
    </script>

</body>

</html>