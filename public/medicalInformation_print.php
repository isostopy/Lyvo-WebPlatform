<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   $userInformation;
   $medicalData;

   $showMedicalData = false;

   if (isset($_GET['user'])) 
   {
      $userId = $_GET['user'];
      
      try
      {
         $userInformation = UserGetData_FilterAllUsers($userId);
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

            <h1>Historia clínica</h1>

            <p class="margin-bottom-20px">A continuación se muestra la historia clínica del usuario.</p>

            <?php

               if(isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

            ?>
            
            <div id="medicalInformation" style="<?php echo $mostrarElemento ? 'display: block;' : 'display: none;'; ?>">

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
               <p class="margin-bottom-10px"><?php echo isset($medicalData->adress1) ? $medicalData->adress1 : 'No consta'; ?></p>
               <p class="margin-bottom-20px"><?php echo isset($medicalData->adress2) ? $medicalData->adress2 : 'No consta'; ?></p>

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
               <p class="margin-bottom-20px"><?php echo isset($medicalData->sex) ? $medicalData->sex : 'No consta'; ?></p>
               
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