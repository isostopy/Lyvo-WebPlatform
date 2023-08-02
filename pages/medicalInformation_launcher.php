<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);

   // Si el usuario ya tiene historia clínica, enviar al 3D.
   if(isset($_SESSION['userData']->data->MedicalInformation)) 
   {
      LoadPage("public/3D_Launcher.php");
   }

   // Si no tiene historia clínica, dar la opción de rechazar o rellenar la información.
   // Si rechaza la información hay que guardar algo para que la próxima vez salte esto.
   if(isset($_POST['fill'])) 
   { 
      LoadPage("pages/medicalInformation_form.php");
   } 
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
      LoadPage("public/3D_Launcher.php");
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
         <h3>HISTORIA CLÍNICA</h3>

         <?php
            if(isset($error))
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         ?>

         <input type="submit" name="fill" value="COMPLETAR" class="form-btn">
         <input type="submit" name="skip" value="SALTAR" class="form-btn">

      </form>
   
   </div>
   
   </body>
</html>