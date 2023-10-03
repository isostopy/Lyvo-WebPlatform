<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   // Datos.
   require_once '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession();

   // Si el usuario ya tiene historia clínica, enviar al 3D, aunque no se debería
   // entrar en esta página si el usuario ya tiene historia clínica completada o saltada.
   // El bypass se debería haber realizado en el Login, el siguiente código es por seguridad.

   if(isset($_SESSION['userData']->data->MedicalInformation)) 
   {
      LoadPage("public/3d_launcher.php");
      $_SESSION['medicalInfoFirstTime'] = false;
   }

   
   // Si el usuario entra en esta página es porque es su primera sesión. Guardamos valor para
   // más adelante saltar la página de "Todo listo".
   $_SESSION['medicalInfoFirstTime'] = true;



   // Si no tiene historia clínica, dar la opción de rechazar o rellenar la información.
   // Si rechaza la información hay que guardar algo para que la próxima vez salte esto.
   if(isset($_POST['skip'])) 
   {
      $data = array(
         "MedicalInformation" => array(
             "status" => "skipped"
         )
      );
      $json = json_encode($data);

      // Guardar
      UserMedicalInformationSave($json);

      // Cargar
      LoadPage("public/3d_launcher.php");
   }
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

            <div class="panel-content max-width-400px">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h2 class="text-color-blue">Vamos a completar tu historia clínica</h2>
               </div>  

               <div class="margin-bottom-40px"></div>

               <div class="panel-subpanels-container">

                  <div class="panel-sub flex-column">

                     <p>Queremos conocerte mejor para poderte dar el mejor servicio.</p>

                     <div class="margin-bottom-20px"></div>

                     <p>Si rellenas tu historia clínica, podrás conectar con los mejores profesionales e intercambiar información de manera sencilla y totalmente confidencial.</p>

                     <div class="margin-bottom-20px"></div>

                     <button class="button-general button-color" id="enter-button" onclick="location.href = 'medicalInformation_form.php' ">EMPEZAR</button>
               

                     <div class="margin-bottom-10px"></div>

                     <form action="" method="post">
                        <p class="element-info-detail">¿Quieres ir directamente a Lyvo World? Podrás completar tu historia más tarde. <button type="submit" name="skip" value="1" class="button-text">SALTAR</button></p>
                     </form>

                     <?php if(isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; } ?>

                  </div>

               </div>

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

</body>

</html>