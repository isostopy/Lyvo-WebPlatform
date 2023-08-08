<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);

   // Si el usuario entra en esta página, hay que mostrar la página de comenzar viaje.
   $_SESSION['userMedicalInfoEnter'] = true;

   // Si el usuario ya tiene historia clínica, enviar al 3D.
   if(isset($_SESSION['userData']->data->MedicalInformation)) 
   {
      LoadPage("public/3D_launcher.php");
   }

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
      MedicalInformationSave($json);

      // Cargar
      LoadPage("public/3d_launcher.php");
   }
?>

<!DOCTYPE html>
<html>

<head>

   <link rel="stylesheet" href="../assets/css/lyvo_style.css">

</head>

<body>
   <div class="main-container">

      <div id="lyvo-logo">
         <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
      </div>

      <div id="left-panel">

         <div id="hoja-livo"></div>

         <div class="content">

            <h1>Vamos a completar tu <br> historia clínica</h1>

            <p class="margin-bottom-20px">Queremos conocerte mejor para poder darte el mejor servicio.</p>
            <p class="margin-bottom-30px">Si rellenas tu historia clínica, podrás conectar con los mejores profesionales e intercambiar información de manera sencilla y totalmente confidencial.</p>

            <button class="button-general" id="enter-button" onclick="location.href = 'medicalInformation_form.php' ">EMPEZAR</button>
            

            <form action="" method="post">
               <p class="texto-bajo-boton">¿Quieres ir directamente a Lyvo World? Podrás completar tu historia más tarde.
                  <button type="submit" name="skip" value="1" class="button-text">SALTAR</button>
               </p>
            </form>

            <?php

               if(isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

            ?>

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

      <div id="right-panel">

      </div>

      <div id="hoja-livo-grande">

      </div>

   </div>

</body>

</html>