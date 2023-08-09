<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);
   
   // Mostrar información
   $userData = $_SESSION['userData']->data;
   $medicalData = $userData->MedicalInformation;

   // Mensaje final.
   $message = "";

   // Recoger la información del formulario.
   if(isset($_POST['submitInfo']))
   {
      $medicalInformation = array(

         "first_name" => $_POST['medical-info-name'],
         "last_name" => $_POST['medical-info-surname'],
         
         "MedicalInformation" => array(

            'sex' => $_POST['medical-info-sex'],
            'birthdate' => $_POST['medical-info-birthdate'],
            'phone' => $_POST['medical-info-phone'],
            'address1' => $_POST['medical-info-address1'],
            'address2' => $_POST['medical-info-address2'],
            'nationality' => $_POST['medical-info-nationality'],
            'work' => $_POST['medical-info-work'],
            'marital' => $_POST['medical-info-marital'],
            'diet' => $_POST['medical-info-diet'],
            'sport' => $_POST['medical-info-sport'],
            'sleep' => $_POST['medical-info-sleep'],
            'diseases' => $_POST['medical-info-diseases'],
            'allergies' => $_POST['medical-info-allergies'],
            'surgeries' => $_POST['medical-info-surgeries'],
            'relatives' => $_POST['medical-info-relatives'],
            'notes' => $_POST['medical-info-notes']
         )
      );

      $jsonBody = json_encode($medicalInformation, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

      // Enviar información.
      MedicalInformationSave($jsonBody);

      $message = "Información almacenada con éxito.";

      LoadPage("public/3d_launcher.php");
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
   <link rel="stylesheet" href="../assets/css/medicalInformation_form.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/medicalInformation_form.js"></script>
   <script src="../assets/js/input_field_utilities.js"></script>

</head>

<body>
   <div class="main-container">

      <div id="lyvo-logo">
         <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
      </div>

      <div id="left-panel">

         <div id="hoja-livo"></div>

         <div class="content">

            <div id="botones-circulares">

               <!--<div class="linea"></div>-->
               <div class="boton-circular" id="page_1_marker"><p>1</p></div>
               <div class="boton-circular" id="page_2_marker"><p>2</p></div>
               <div class="boton-circular" id="page_3_marker"><p>3</p></div>

            </div>

            <h1>Historia clínica</h1>

            <form action="" method="post">

               <div class="content-main margin-bottom-20px" id="page_1">

                  <div id="texto-izquierda">

                     <p>A continuación encontrará una serie de preguntas con relación su salud.</p>
                     <p><br>Es sumamente importante responda de forma honesta ya que estas son transcendentales para ofrecerle el mejor servicio.</p>
                     <p><br>Rellenar este formulario no le llevará más de 5 min.</p>

                  </div>

                  <div id="nombre-apellido">
                     <div class="content-label">

                        <h2>Nombre</h2>

                        <div class="input-icon">

                           <i id="name-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="name-input" type="text" name="medical-info-name" placeholder="Nombre" value="<?php echo isset($userData->first_name) ? $userData->first_name : ''; ?>">

                        </div>
                     </div>

                     <div class="content-label">
                        
                        <h2>Apellidos</h2>

                        <div class="input-icon">

                           <i id="surname-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="surname-input" type="text" name="medical-info-surname" placeholder="Apellidos" value="<?php echo isset($userData->last_name) ? $userData->last_name : ''; ?>">

                        </div>

                     </div>

                     <div class="content-label" class="pregunta-radio-group">
                        
                        <h2>Sexo</h2>

                        <label class="input-label-circular">
                           <input class="input-field-label margin-right-5px" value="masculino" name="medical-info-sex" type="radio" <?php echo (isset($medicalData->sex) && $medicalData->sex=='masculino')?'checked':'' ?>>
                           <p class="radio-text">Masculino</p>
                        </label>
                        <label class="input-label-circular">
                           <input class="input-field-label margin-right-5px" value="femenino" name="medical-info-sex" type="radio" <?php echo (isset($medicalData->sex) && $medicalData->sex=='femenino')?'checked':'' ?>>
                           <p class="radio-text">Femenino</p>
                        </label>

                     </div>

                  </div>
               </div>

               <div class="content-main margin-bottom-20px" id="page_2" style="display:none">

                  <div id="campos-izquierda">

                     <div class="content-label">
                        <h2>Fecha de Nacimiento</h2>

                        <div class="input-icon">
                           <i id="birthdate-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="birthdate-input" type="text" name="medical-info-birthdate" placeholder="DD/MM/AAAA" value="<?php echo isset($medicalData->diet) ? $medicalData->diet : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Teléfono</h2>

                        <div class="input-icon">
                           <i id="phone-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="phone-input" type="text" name="medical-info-phone" placeholder="+34 000000000" value="<?php echo isset($medicalData->phone) ? $medicalData->phone : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Dirección</h2>

                        <div class="input-icon margin-bottom-10px">
                           <i id="address1-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="address1-input" type="text" name="medical-info-address1" placeholder="Dirección" value="<?php echo isset($medicalData->address1) ? $medicalData->address1 : ''; ?>">
                        </div>

                        <div class="input-icon">
                           <i id="address2-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="address2-input" type="text" name="medical-info-address2" placeholder="Dirección" value="<?php echo isset($medicalData->address2) ? $medicalData->address2 : ''; ?>">
                        </div>

                     </div>

                  </div>

                  <div id="campos-derecha">

                     <div class="content-label">
                        <h2>Nacionalidad</h2>

                        <div class="input-icon">
                           <i id="nationality-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="nationality-input" type="text" name="medical-info-nationality" placeholder="Nacionalidad" value="<?php echo isset($medicalData->nationality) ? $medicalData->nationality : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Profesión</h2>

                        <div class="input-icon">
                           <i id="work-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="work-input" type="text" name="medical-info-work" placeholder="Profesión" value="<?php echo isset($medicalData->work) ? $medicalData->work : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Estado civil</h2>

                        <div class="input-icon">
                           <i id="marital-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="marital-input" type="text" name="medical-info-marital" placeholder="Estado civil" value="<?php echo isset($medicalData->marital) ? $medicalData->marital : ''; ?>">
                        </div>
                     </div>
                     
                  </div>

               </div>

               <div class="content-main margin-bottom-20px"  id="page_3" style="display:none">

                  <div id="campos-izquierda">

                     <div class="content-label">
                        <h2>Alimentación</h2>

                        <div class="input-icon">
                           <i id="diet-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="diet-input" type="text" name="medical-info-diet" placeholder="Alimentación" value="<?php echo isset($medicalData->diet) ? $medicalData->diet : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Deporte</h2>

                        <div class="input-icon">
                           <i id="sport-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="sport-input" type="text" name="medical-info-sport" placeholder="Deporte" value="<?php echo isset($medicalData->sport) ? $medicalData->sport : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Sueño</h2>

                        <div class="input-icon">
                           <i id="sleep-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="sleep-input" type="text" name="medical-info-sleep" placeholder="Sueño" value="<?php echo isset($medicalData->sleep) ? $medicalData->sleep : ''; ?>">
                        </div>
                     </div>

                     <div class="content-column">

                        <div class="content-label" class="pregunta-radio-group">
                           
                           <h2>Alcohol</h2>

                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="none" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='masculino')?'checked':'' ?>>
                              <p class="radio-text">Nulo</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="medium" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Ocasional</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="high" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Alto</p>
                           </label>

                        </div>

                        <div class="content-label" class="pregunta-radio-group">
                           
                           <h2>Tabaco</h2>

                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="none" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='masculino')?'checked':'' ?>>
                              <p class="radio-text">Nulo</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="medium" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Ocasional</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="high" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Alto</p>
                           </label>

                        </div>

                        <div class="content-label" class="pregunta-radio-group">
                           
                           <h2>Drogas</h2>

                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="none" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='masculino')?'checked':'' ?>>
                              <p class="radio-text">Nulo</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="medium" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Ocasional</p>
                           </label>
                           <label class="input-label-circular">
                              <input class="input-field-label margin-right-5px" value="high" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='femenino')?'checked':'' ?>>
                              <p class="radio-text">Alto</p>
                           </label>

                        </div>

                     </div>
                     
                  </div>

                  <div id="campos-derecha">
                     
                     <div class="content-label">
                        <h2>Enfermedades</h2>

                        <div class="input-icon">
                           <i id="diseases-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="diseases-input" type="text" name="medical-info-diseases" placeholder="Enfermedades" value="<?php echo isset($medicalData->diseases) ? $medicalData->diseases : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Alergias</h2>

                        <div class="input-icon">
                           <i id="allergies-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="allergies-input" type="text" name="medical-info-allergies" placeholder="Alergias" value="<?php echo isset($medicalData->allergies) ? $medicalData->allergies : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Cirugías</h2>

                        <div class="input-icon">
                           <i id="surgeries-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="surgeries-input" type="text" name="medical-info-surgeries" placeholder="Cirugías" value="<?php echo isset($medicalData->surgeries) ? $medicalData->surgeries : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Antecedentes familiares</h2>

                        <div class="input-icon">
                           <i id="relatives-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="relatives-input" type="text" name="medical-info-relatives" placeholder="Antecedentes familiares" value="<?php echo isset($medicalData->relatives) ? $medicalData->relatives : ''; ?>">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Observaciones</h2>

                        <div class="input-icon">
                           <i id="notes-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="notes-input" type="text" name="medical-info-notes" placeholder="Observaciones" value="<?php echo isset($medicalData->notes) ? $medicalData->notes : ''; ?>">
                        </div>
                     </div>

                  </div>

               </div>

               <?php

                  //if (!empty($message)) { echo '<span class="msg msg-confirm">'.$message.'</span>'; }

                  if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

               ?>

               <button type="button" id="button-next" class="button-general margin-bottom-10px">SIGUIENTE</button>
               <button type="button" id="button-back" class="button-general">ATRAS</button>
      
               <input id="button-end" type="submit" name="submitInfo" value="FINALIZAR" class="form-btn">

               <p class="texto-bajo-boton">¿Quieres ir directamente a Lyvo World? Podrás completar tu historia más tarde. <a href="medicalInformation_launcher.php">SALTAR</a></p>

            </form>

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

   <script>

      fieldChecker_Load('name-input', 'name-check-icon', null, 1);
      fieldChecker_Load('surname-input', 'surname-check-icon', null, 1);
      fieldChecker_Load('birthdate-input', 'birthdate-check-icon', null, 10);
      fieldChecker_Load('phone-input', 'phone-check-icon', null, 13);
      fieldChecker_Load('address1-input', 'address1-check-icon', null, 3);
      fieldChecker_Load('address2-input', 'address2-check-icon', null, 3);
      fieldChecker_Load('nationality-input', 'nationality-check-icon', null, 3);
      fieldChecker_Load('work-input', 'work-check-icon', null, 3);
      fieldChecker_Load('marital-input', 'marital-check-icon', null, 3);
      fieldChecker_Load('diet-input', 'diet-check-icon', null, 3);
      fieldChecker_Load('sport-input', 'sport-check-icon', null, 3);
      fieldChecker_Load('sleep-input', 'sleep-check-icon', null, 3);
      fieldChecker_Load('diseases-input', 'diseases-check-icon', null, 3);
      fieldChecker_Load('allergies-input', 'allergies-check-icon', null, 3);
      fieldChecker_Load('surgeries-input', 'surgeries-check-icon', null, 3);
      fieldChecker_Load('relatives-input', 'relatives-check-icon', null, 3);
      fieldChecker_Load('notes-input', 'notes-check-icon', null, 3);
   
   </script>

</body>

</html>