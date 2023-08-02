<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);
   
   // Mostrar información
   $medicalData = $_SESSION['userData']->data->MedicalInformation;

   // Mensaje final.
   $message = "";

   // Recoger la información del formulario.
   if(isset($_POST['submitInfo']))
   {
      $medicalInformation = array(
         'age' => $_POST['age'],
         'birth' => $_POST['birth'],
         'nationality' => $_POST['nationality'],
         'address' => $_POST['address'],
         'alcohol' => $_POST['alcohol'],
         'tobacco' => $_POST['tobacco'],
         'drugs' => $_POST['drugs'],
         'sleep' => $_POST['sleep'],
         'diet' => $_POST['diet'],
         'sport' => $_POST['sport'],
         'cv' => $_POST['cv'],
         'allergies' => $_POST['allergies'],
         'familyHistory' => $_POST['familyHistory']
      );

      $finalArray = array('MedicalInformation' => $medicalInformation);

      $jsonBody = json_encode($finalArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

      // Enviar información.
      MedicalInformationSave($jsonBody);

      $message = "Información almacenada con éxito.";
   }

   if(isset($_POST['continue']))
   {
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
      <title>register form</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="../assets/css/style.css">

   </head>
   <body>
      
   <div class="form-container">

      <form action="" method="post">
         
         <!-- Historia médica-->
         <h3>Información médica</h3>

         <h2>Información personal</h2>
         <input type="text" name="age" placeholder="Edad" value="<?php echo isset($medicalData->age) ? $medicalData->age : ''; ?>">
         <input type="text" name="birth" placeholder="Fecha de nacimiento" value="<?php echo isset($medicalData->birth) ? $medicalData->birth : ''; ?>">
         <input type="text" name="nationality" placeholder="Nacionalidad" value="<?php echo isset($medicalData->nationality) ? $medicalData->nationality : ''; ?>">
         <input type="text" name="address" placeholder="Dirección" value="<?php echo isset($medicalData->address) ? $medicalData->address : ''; ?>">

         <h2>Hábitos</h2>
         <input type="text" name="alcohol" placeholder="Alcohol" value="<?php echo isset($medicalData->alcohol) ? $medicalData->alcohol : ''; ?>">
         <input type="text" name="tobacco" placeholder="Tabaco" value="<?php echo isset($medicalData->tobacco) ? $medicalData->tobacco : ''; ?>">
         <input type="text" name="drugs" placeholder="Drogas" value="<?php echo isset($medicalData->drugs) ? $medicalData->drugs : ''; ?>">
         <input type="text" name="sleep" placeholder="Sueño" value="<?php echo isset($medicalData->sleep) ? $medicalData->sleep : ''; ?>">
         <input type="text" name="diet" placeholder="Dieta" value="<?php echo isset($medicalData->diet) ? $medicalData->diet : ''; ?>">
         <input type="text" name="sport" placeholder="Deporte" value="<?php echo isset($medicalData->sport) ? $medicalData->sport : ''; ?>">

         <h2>Enfermedades</h2>
         <input type="text" name="cv" placeholder="Descripción general" value="<?php echo isset($medicalData->cv) ? $medicalData->cv : ''; ?>">
         <input type="text" name="allergies" placeholder="Alergias" value="<?php echo isset($medicalData->allergies) ? $medicalData->allergies : ''; ?>">

         <h2>Antecedentes familiares</h2>
         <input type="text" name="familyHistory" placeholder="Antecedentes familiares" value="<?php echo isset($medicalData->familyHistory) ? $medicalData->familyHistory : ''; ?>">

         <!-- Historia médica-->

         <?php

            if (!empty($message)) 
            {
               echo '<span class="confirm-msg">'.$message.'</span>';
            }

            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }

         ?>

         <input type="submit" name="submitInfo" value="GUARDAR INFORMACIÓN" class="form-btn">
         
         <input type="submit" name="continue" value="CONTINUAR" class="form-btn">

      </form>

   </div>

   </body>
</html>