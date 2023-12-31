<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Datos.
   require_once '../includes/config.php';

   $userInformation;
   $medicalData;

   $showMedicalData = false;

   // Local id test = 1a704fff-dd70-4688-842a-9b90e0ebf5a7

   if (isset($_GET['user'])) 
   {
      $userId = $_GET['user'];
      
      try
      {
         $userInformation = UserGetDataById($userId);
         $medicalData = $userInformation->MedicalInformation;

         // Mostrar los campos de la información médica si el usuario está registrado.
         $showMedicalData = true;
      }
      catch (Exception $e)
      {
         $error = $e->getMessage();
      }
   }
?>



<!DOCTYPE html>
<html>

<head>

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lyvo Historia</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
   
   <link rel="stylesheet" href="../assets/css/style_lyvo.css">

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
               <h1 class="text-color-blue">Historia clínica</h1>
            </div> 

            <div class="margin-bottom-40px"></div>

            <p class="margin-bottom-20px">A continuación se muestra la historia clínica del usuario.</p>

            <div class="panel-sub flex-column panel-background-white overflow-scroll padding-left-50px text-color-blue height-500px">

               <?php

                  if(isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

               ?>
               
               <div id="medicalInformation" style="<?php echo $showMedicalData ? 'display: block;' : 'display: none;'; ?>">

                  <h2>Nombre</h2>
                  <p class="margin-bottom-20px"><?php echo isset($userInformation->first_name) ? $userInformation->first_name : 'No consta'; ?></p>

                  <h2>Apellidos</h2>
                  <p class="margin-bottom-20px"><?php echo isset($userInformation->last_name) ? $userInformation->last_name : 'No consta'; ?></p>

                  <h2>Sexo</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->sex) ? $medicalData->sex : 'No consta'; ?></p>

                  <h2>Fecha de nacimiento</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->birthdate) ? $medicalData->birthdate : 'No consta'; ?></p>

                  <h2>Teléfono</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->phone) ? $medicalData->phone : 'No consta'; ?></p>

                  <h2>Dirección</h2>
                  <p class="margin-bottom-10px"><?php echo isset($medicalData->address1) ? $medicalData->address1 : 'No consta'; ?></p>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->address2) ? $medicalData->address2 : 'No consta'; ?></p>

                  <h2>Nacionalidad</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->nationality) ? $medicalData->nationality : 'No consta'; ?></p>

                  <h2>Ocupación</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->work) ? $medicalData->work : 'No consta'; ?></p>

                  <h2>Estado civil</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->marital) ? $medicalData->marital : 'No consta'; ?></p>

                  <h2>Alimentación</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->diet) ? $medicalData->diet : 'No consta'; ?></p>

                  <h2>Deporte</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->sport) ? $medicalData->sport : 'No consta'; ?></p>

                  <h2>Sueño</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->sleep) ? $medicalData->sleep : 'No consta'; ?></p>
                  
                  <h2>Alcohol</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->alcohol) ? $medicalData->alcohol : 'No consta'; ?></p>

                  <h2>Tabaco</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->tobacco) ? $medicalData->tobacco : 'No consta'; ?></p>

                  <h2>Drogas</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->drugs) ? $medicalData->drugs : 'No consta'; ?></p>

                  <h2>Enfermedades</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->diseases) ? $medicalData->diseases : 'No consta'; ?></p>

                  <h2>Alergias</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->allergies) ? $medicalData->allergies : 'No consta'; ?></p>

                  <h2>Cirugías</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->surgeries) ? $medicalData->surgeries : 'No consta'; ?></p>

                  <h2>Antecedentes familiares</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->relatives) ? $medicalData->relatives : 'No consta'; ?></p>

                  <h2>Observaciones</h2>
                  <p class="margin-bottom-20px"><?php echo isset($medicalData->notes) ? $medicalData->notes : 'No consta'; ?></p>

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