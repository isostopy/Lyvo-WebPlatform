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
         Register($_POST['name'], $_POST['surname'],$_POST['email'],$_POST['password'],UserType::CLIENT,UserStatus::INVITED,true);

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

   <link rel="stylesheet" href="../assets/css/style_lyvo_general_updated.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/input_field_utilities.js"></script>

</head>

<body>


   <!-- CONTENEDOR PRINCIPAL -->
   <div id="content">

      <!-- HEADER -->
      <div id="header">

         <!-- LOGO -->
         <img id="logo" src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">

      </div>

      <!-- PANELS -->
      <div id="panels">

         <!-- PANEL IZQUIERDO -->
         <div id="panel-left">

            <div class="panel-content">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">Crear cuenta</h1>
               </div>   

               <div class="margin-bottom-40px"></div>

               <!-- FORM -->
               <form action="" method="post">

                  <div class="panel-subpanels-container">

                     <!-- Panel 1 -->
                     <div class="panel-sub">

                        <!-- Field -->
                        <div>
                           <h2 class="text-color-blue">Nombre</h2>
                           <div class="margin-bottom-5px"></div>
                           <input id="input-name" type="text" name="name" placeholder="nombre" required>
                        </div>
                        <div class="margin-bottom-20px"></div>
                        <div>
                           <h2 class="text-color-blue">E-mail</h2>
                           <div class="margin-bottom-5px"></div>
                           <input id="input-email" type="email" name="email" placeholder="e-mail" required>
                        </div>

                     </div>
                     <div class="margin-bottom-20px"></div>

                     <div class="margin-right-20px"></div>

                     <!-- Panel 2 -->
                     <div class="panel-sub">

                        <!-- Field -->
                        <div>
                           <h2 class="text-color-blue">Apellidos</h2>
                           <div class="margin-bottom-5px"></div>
                           <input id="input-surname" type="text" name="surname" placeholder="apellido" required>
                        </div>
                        <div class="margin-bottom-20px"></div>
                        <div>
                           <h2 class="text-color-blue">Contraseña</h2>
                           <div class="margin-bottom-5px"></div>
                           <input id="input-pass" type="password" name="password" placeholder="contraseña" required>
                           <div class="margin-bottom-5px"></div>
                           <p class="element-info">La contraseña debe tener al menos 6 caracteres</p>
                        </div>

                     </div>

                  </div>

                  <div class="margin-bottom-40px"></div>

                  <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } ?>
                  <input id="button-create" type="submit" name="submit" value="CREAR CUENTA" class="button-general button-color">
                  
                  
               </form>

            </div>

            <p class="texto-bajo-boton">¿Ya tienes una cuenta? <a href="login_form.php">ENTRAR</a></p>

         </div>

         <!-- PANEL DERECHO -->
         <div id="panel-right">

            <img src="../assets/images/web-image-01.jpg" alt="Lyvo" class="img-fullsize">

         </div>

      </div>

      <?php include_once "../utils/htmlFooter.php"; ?>

   </div>

   <script>

      passDisplay_Load('input-pass','show-pass-icon','hide-pass-icon');
      
      fieldChecker_Load('input-name', 'name-check-icon', undefined, 1);
      fieldChecker_Load('input-surname', 'surname-check-icon', undefined, 1);
      fieldChecker_Load('input-email', 'email-check-icon', ['@','.'], 6);    
      fieldChecker_Load('input-pass', 'pass-check-icon', undefined, 6);
   
    </script>

</body>

</html>