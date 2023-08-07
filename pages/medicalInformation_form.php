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
         'name' => $_POST['medical-info-name'],
         'surname' => $_POST['medical-info-surname'],
         'sex' => $_POST['medical-info-sex']
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
      LoadPage("public/3D_launcher.php");
   }
?>



<!DOCTYPE html>
<html>

<head>

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

               <div class="content-main" id="page_1">

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
                           <input id="name-input" type="text" name="medical-info-name" value="<?php echo isset($userData->first_name) ? $userData->first_name : ''; ?>">

                        </div>
                     </div>

                     <div class="content-label">
                        
                        <h2>Apellidos</h2>

                        <div class="input-icon">

                           <i id="surname-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="surname-input" type="text" name="medical-info-surname" value="<?php echo isset($userData->last_name) ? $userData->last_name : ''; ?>">

                        </div>

                     </div>

                     <div class="content-label" id="pregunta-radio-group">
                        
                     <h2>Sexo</h2>

                     <label>
                        <input class="input-field" value="masculino" name="medical-info-sex" type="radio" <?php echo (isset($medicalInformation->sex) && $medicalInformation->sex=='masculino')?'checked':'' ?>>
                        <p class="radio-text">Masculino</p>
                     </label>
                     <label>
                        <input class="input-field" value="femenino" name="medical-info-sex" type="radio" <?php echo (isset($medicalInformation->sex) && $medicalInformation->sex=='femenino')?'checked':'' ?>>
                        <p class="radio-text">Femenino</p>
                     </label>

                     </div>

                  </div>
               </div>

               <div class="content-main" id="page_2" style="display:none">

                  <div id="campos-izquierda">

                     <div class="content-label">
                        <h2>Fecha de Nacimiento</h2>

                        <div class="input-icon">
                           <i id="birthdate-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                           <input id="birthdate-input" type="text" placeholder="DD/MM/AAAA">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Teléfono</h2>

                        <div class="input-icon">
                           <i class="fa fa-check icon-left" id="telefono-check-icon"></i>

                           <input class="input-field" id="telefono-input" type="text" placeholder="+34 000000000">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Dirección</h2>

                        <div class="input-icon">
                           <i class="fa fa-check icon-left" id="direccion-check-icon"></i>
                           <input class="input-field" id="direccion1-input" type="text" placeholder="Calle">
                        </div>

                        <div class="input-icon">
                           <i class="fa fa-check icon-left" id="direccion2-check-icon"></i>
                           <input class="input-field" id="direccion2-input" type="text" placeholder="Calle 2">
                        </div>

                     </div>


                  </div>

                  <div id="campos-derecha">
                     <div class="content-label">
                        <h2>Pregunta</h2>

                        <div class="input-icono">
                           <i class="fa fa-check icon" id="pregunta-check-icon"></i>
                           <input class="input-field" id="pregunta-input" type="text" placeholder="respuesta">
                        </div>
                     </div>


                     <div class="content-label" id="pregunta-radio-group">
                        <h2>Pregunta</h2>

                        <label>
                           <input class="input-field" value="1" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="2" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="3" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                     </div>

                     <div class="content-label" id="pregunta-radio-group">
                        <h2>Pregunta</h2>

                        <label>
                           <input class="input-field" value="1" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="2" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="3" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                     </div>

                  </div>

               </div>

               <div class="content-main" id="page_3" style="display:none">

                  <div id="campos-izquierda">

                     <div class="content-label">
                        <h2>Fecha de Nacimiento</h2>

                        <div class="input-icono">
                           <i class="fa fa-check icon-left" id="fecha-check-icon"></i>
                           <input class="input-field" id="fecha-input" type="text" placeholder="DD/MM/AAAA">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Teléfono</h2>

                        <div class="input-icono">
                           <i class="fa fa-check icon-left" id="telefono-check-icon"></i>

                           <input class="input-field" id="telefono-input" type="text" placeholder="+34 000000000">
                        </div>
                     </div>

                     <div class="content-label">
                        <h2>Dirección</h2>

                        <div class="input-icono">
                           <i class="fa fa-check icon-left" id="direccion-check-icon"></i>
                           <input class="input-field" id="direccion1-input" type="text" placeholder="Calle">
                        </div>

                        <div class="input-icono">
                           <i class="fa fa-check icon-left" id="direccion2-check-icon"></i>
                           <input class="input-field" id="direccion2-input" type="text" placeholder="Calle 2">
                        </div>

                     </div>


                  </div>

                  <div id="campos-derecha">
                     <div class="content-label">
                        <h2>Pregunta</h2>

                        <div class="input-icono">
                           <i class="fa fa-check icon" id="pregunta-check-icon"></i>
                           <input class="input-field" id="pregunta-input" type="text" placeholder="respuesta">
                        </div>
                     </div>


                     <div class="content-label" id="pregunta-radio-group">
                        <h2>Pregunta</h2>

                        <label>
                           <input class="input-field" value="1" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="2" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="3" name="pregunta1" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                     </div>

                     <div class="content-label" id="pregunta-radio-group">
                        <h2>Pregunta</h2>

                        <label>
                           <input class="input-field" value="1" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="2" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                        <label>
                           <input class="input-field" value="3" name="pregunta2" type="radio">
                           <p class="radio-text">Respuesta</p>
                        </label>

                     </div>

                  </div>

               </div>

            </form>

            <?php

               if (!empty($message)) { echo '<span class="msg msg-confirm">'.$message.'</span>'; }

               if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

            ?>

            <button id="button-next" class="button-general margin-bottom-10px">SIGUIENTE</button>
            <button id="button-back" class="button-general">ATRAS</button>
     
            <input id="button-end" type="submit" name="submit" value="FINALIZAR" class="form-btn">

            <p class="texto-bajo-boton">¿Quieres ir directamente a Lyvo World? Podrás completar tu historia más tarde. <a href="medicalInformation_launcher.php">SALTAR</a></p>

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
   

   </script>

</body>

</html>