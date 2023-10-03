<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   // Datos.
   require_once '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession();
   
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
         "last_name" =>  $_POST['medical-info-surname'],
         
         "MedicalInformation" => array(

            'sex' =>         $_POST['medical-info-sex'],
            'birthdate' =>   $_POST['medical-info-birthdate'],
            'phone' =>       $_POST['medical-info-phone'],
            'address1' =>    $_POST['medical-info-address1'],
            'address2' =>    $_POST['medical-info-address2'],
            'nationality' => $_POST['medical-info-nationality'],
            'work' =>        $_POST['medical-info-work'],
            'marital' =>     $_POST['medical-info-marital'],
            'diet' =>        $_POST['medical-info-diet'],
            'sport' =>       $_POST['medical-info-sport'],
            'sleep' =>       $_POST['medical-info-sleep'],
            'alcohol' =>     $_POST['medical-info-alcohol'],
            'tobacco' =>     $_POST['medical-info-tobacco'],
            'drugs' =>       $_POST['medical-info-drugs'],
            'diseases' =>    $_POST['medical-info-diseases'],
            'allergies' =>   $_POST['medical-info-allergies'],
            'surgeries' =>   $_POST['medical-info-surgeries'],
            'relatives' =>   $_POST['medical-info-relatives'],
            'notes' =>       $_POST['medical-info-notes']
         )
      );

      $jsonBody = json_encode($medicalInformation, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

      // Enviar información.
      UserMedicalInformationSave($jsonBody);

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
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

   <link rel="stylesheet" href="../assets/css/style_lyvo.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/medicalInformation_form.js"></script>
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

               <div id="botones-circulares">

                  <!--<div class="linea"></div>-->
                  <!--<div class="boton-circular" id="page_1_marker"><p>1</p></div>-->
                  <!--<div class="boton-circular" id="page_2_marker"><p>2</p></div>-->
                  <!--<div class="boton-circular" id="page_3_marker"><p>3</p></div>-->

               </div>

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">Historia clínica</h1>
               </div>  

               <div class="margin-bottom-40px"></div>

               <form action="" method="post">

                  <div id="page_1" class="panel-subpanels-container flex-margin-r20-c20">

                     <!-- Panel Sub Izq -->
                     <div class="panel-sub flex-column">

                        <div id="texto-izquierda">

                           <p>A continuación encontrará una serie de preguntas con relación su salud.</p>
                           <p><br>Es sumamente importante responda de forma honesta ya que estas son transcendentales para ofrecerle el mejor servicio.</p>
                           <p><br>Rellenar este formulario no le llevará más de 5 min.</p>

                        </div>
                     
                     </div>

                     <div class="margin-bottom-10px"></div>

                     <!-- Panel Sub Der -->
                     <div class="panel-sub flex-column">

                        <!-- Input field Nombre -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Nombre</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-name" style="visibility:hidden;"></i>
                              <input id="input-name" type="text" name="medical-info-name" placeholder="nombre" value="<?php echo isset($userData->first_name) ? $userData->first_name : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>


                        <!-- Input field Apellidos -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Apellidos</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-surname" style="visibility:hidden;"></i>
                              <input id="input-surname" type="text" name="medical-info-surname" placeholder="apellidos" value="<?php echo isset($userData->last_name) ? $userData->last_name : ''; ?>">
                           </div>
                        </div>
           
                        <div class="margin-bottom-20px"></div>


                        <!-- Input field Sexo -->
                        <div class="panel-element">
                           
                           <h2 class="text-color-blue">Sexo</h2>
                           <div class="margin-bottom-5px"></div>

                           <label class="input-label-circular">
                              <input class="margin-right-5px" value="Masculino" name="medical-info-sex" type="radio" <?php echo (isset($medicalData->sex) && $medicalData->sex=='Masculino')?'checked':'' ?>>
                              <p class="radio-text">Masculino</p>
                           </label>
                           <div class="margin-bottom-5px"></div>
                           <label class="input-label-circular">
                              <input class="margin-right-5px" value="Femenino" name="medical-info-sex" type="radio" <?php echo (isset($medicalData->sex) && $medicalData->sex=='Femenino')?'checked':'' ?>>
                              <p class="radio-text">Femenino</p>
                           </label>

                        </div>

                     </div>

                  </div>

                  <div id="page_2" class="panel-subpanels-container flex-margin-r10-c20" style="display:none">

                     <!-- Panel Sub Izq -->
                     <div class="panel-sub flex-column">

                        <!-- Input field FECHA DE NACIMIENTO -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Fecha de nacimiento</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-birthday" style="visibility:hidden;"></i>
                              <input id="input-birthday" type="text" name="medical-info-birthdate" placeholder="DD/MM/AAAA" value="<?php echo isset($medicalData->birthday) ? $medicalData->birthday : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field TELÉFONO -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Teléfono</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-phone" style="visibility:hidden;"></i>
                              <input id="input-phone" type="text" name="medical-info-phone" placeholder="+34 000000000" value="<?php echo isset($medicalData->phone) ? $medicalData->phone : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field DIRECCIÓN -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Dirección</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-address1" style="visibility:hidden;"></i>
                              <input id="input-address1" type="text" name="medical-info-address1" placeholder="Dirección" value="<?php echo isset($medicalData->address1) ? $medicalData->address1 : ''; ?>">
                           </div>
                           <div class="margin-bottom-5px"></div>
                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-address2" style="visibility:hidden;"></i>
                              <input id="input-address2" type="text" name="medical-info-address2" placeholder="Dirección" value="<?php echo isset($medicalData->address2) ? $medicalData->address2 : ''; ?>">
                           </div>
                        </div>

                     </div>

                     <!-- Panel Sub Der -->
                     <div class="panel-sub flex-column">

                        <!-- Input field NACIONALIDAD -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Nacionalidad</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-nationality" style="visibility:hidden;"></i>
                              <input id="input-nationality" type="text" name="medical-info-nationality" placeholder="Nacionalidad" value="<?php echo isset($medicalData->nationality) ? $medicalData->nationality : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>


                        <!-- Input field PROFESIÓN -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Profesion</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-work" style="visibility:hidden;"></i>
                              <input id="input-work" type="text" name="medical-info-work" placeholder="Profesión" value="<?php echo isset($medicalData->work) ? $medicalData->work : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field ESTADO CIVIL -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Estado civil</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-marital" style="visibility:hidden;"></i>
                              <input id="input-marital" type="text" name="medical-info-marital" placeholder="Estado" value="<?php echo isset($medicalData->marital) ? $medicalData->marital : ''; ?>">
                           </div>
                        </div>
                        
                     </div>

                  </div>

                  <div id="page_3" class="panel-subpanels-container" style="display:none">

                     <!-- Panel Sub Izq -->
                     <div class="panel-sub flex-column">

                        <!-- Input field NACIONALIDAD -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Alimentación</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-diet" style="visibility:hidden;"></i>
                              <input id="input-diet" type="text" name="medical-info-diet" placeholder="Alimentación" value="<?php echo isset($medicalData->diet) ? $medicalData->diet : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field DEPORTE -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Deporte</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-sport" style="visibility:hidden;"></i>
                              <input id="input-sport" type="text" name="medical-info-sport" placeholder="Deporte" value="<?php echo isset($medicalData->sport) ? $medicalData->sport : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field SUEÑO -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Sueño</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-sleep" style="visibility:hidden;"></i>
                              <input id="input-sleep" type="text" name="medical-info-sleep" placeholder="Sueño" value="<?php echo isset($medicalData->sleep) ? $medicalData->sleep : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field ALCOHOL / TABACO / DROGAS -->
                        <div class="panel-subpanels-container flex-margin-r10-c20">

                           <div>
                              
                              <h2 class="text-color-blue">Alcohol</h2>
                              <div class="margin-bottom-5px"></div>

                              <label class="input-label-circular">
                                 <input class="margin-right-5px" value="Nulo" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='Nulo')?'checked':'' ?>>
                                 <p>Nulo</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="margin-right-5px" value="Medio" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='Medio')?'checked':'' ?>>
                                 <p>Ocasional</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="margin-right-5px" value="Alto" name="medical-info-alcohol" type="radio" <?php echo (isset($medicalData->alcohol) && $medicalData->alcohol=='Alto')?'checked':'' ?>>
                                 <p>Alto</p>
                              </label>

                           </div>

                           <div>
                              
                              <h2 class="text-color-blue">Tabaco</h2>
                              <div class="margin-bottom-5px"></div>

                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Nulo" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='Nulo')?'checked':'' ?>>
                                 <p class="radio-text">Nulo</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Medio" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='Medio')?'checked':'' ?>>
                                 <p class="radio-text">Ocasional</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Alto" name="medical-info-tobacco" type="radio" <?php echo (isset($medicalData->tobacco) && $medicalData->tobacco=='Alto')?'checked':'' ?>>
                                 <p class="radio-text">Alto</p>
                              </label>

                           </div>

                           <div>
                              
                              <h2 class="text-color-blue">Drogas</h2>
                              <div class="margin-bottom-5px"></div>

                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Nulo" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='Nulo')?'checked':'' ?>>
                                 <p class="radio-text">Nulo</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Medio" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='Medio')?'checked':'' ?>>
                                 <p class="radio-text">Ocasional</p>
                              </label>
                              <label class="input-label-circular">
                                 <input class="input-field-label margin-right-5px" value="Alto" name="medical-info-drugs" type="radio" <?php echo (isset($medicalData->drugs) && $medicalData->drugs=='Alto')?'checked':'' ?>>
                                 <p class="radio-text">Alto</p>
                              </label>

                           </div>

                        </div>
                        
                     </div>

                     <div class="margin-bottom-10px"></div>

                     <!-- Panel Sub Der -->
                     <div class="panel-sub flex-column">
                        
                        <!-- Input field ENFERMEDADES -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Enfermedades</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-diseases" style="visibility:hidden;"></i>
                              <input id="input-diseases" type="text" name="medical-info-diseases" placeholder="Enfermedades" value="<?php echo isset($medicalData->diseases) ? $medicalData->diseases : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field ALERGIAS -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Alergias</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-allergies" style="visibility:hidden;"></i>
                              <input id="input-allergies" type="text" name="medical-info-allergies" placeholder="Alergias" value="<?php echo isset($medicalData->allergies) ? $medicalData->allergies : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field CIRUGÍAS -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Cirugías</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-surgeries" style="visibility:hidden;"></i>
                              <input id="input-surgeries" type="text" name="medical-info-surgeries" placeholder="Cirugías" value="<?php echo isset($medicalData->surgeries) ? $medicalData->surgeries : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field ANTECEDENTES -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Antecedentes familiares</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-relatives" style="visibility:hidden;"></i>
                              <input id="input-relatives" type="text" name="medical-info-relatives" placeholder="Antecedentes familiares" value="<?php echo isset($medicalData->relatives) ? $medicalData->relatives : ''; ?>">
                           </div>
                        </div>

                        <div class="margin-bottom-10px"></div>

                        <!-- Input field ANTECEDENTES -->
                        <div class="panel-element">
                           <h2 class="text-color-blue">Observaciones</h2>
                           <div class="margin-bottom-5px"></div>

                           <div class="input-field-icon-container">
                              <i class="fa fa-check input-field-icon-icon" id="icon-check-notes" style="visibility:hidden;"></i>
                              <input id="input-notes" type="text" name="medical-info-notes" placeholder="Observaciones" value="<?php echo isset($medicalData->notes) ? $medicalData->notes : ''; ?>">
                           </div>
                        </div>

                     </div>

                  </div>

                  <div class="margin-bottom-40px"></div>

                  <?php if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; } ?>

                  <!-- Metemos el margen dentro del botón para que funcione si el botón está activado o desactivado -->
                  <button type="button" id="button-next" class="button-general button-color margin-bottom-10px">SIGUIENTE</button>
                  <button type="button" id="button-back" class="button-general button-color margin-bottom-10px">ATRAS</button>
                  <input id="button-end" type="submit" name="submitInfo" value="FINALIZAR" class="button-general button-color margin-bottom-10px">

                  <p class="element-info-detail">¿Quieres ir directamente a Lyvo World? Podrás completar tu historia más tarde. <button type="submit" name="skip" value="1" class="button-text">SALTAR</button></p>

                  <div class="margin-bottom-40px"></div>

               </form>

               <div class="lyvo-leaf lyvo-leaf-solid"></div>

            </div>

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

      fieldChecker_Load('input-name', 'icon-check-name', null, 1);
      fieldChecker_Load('input-surname', 'icon-check-surname', null, 1);
      fieldChecker_Load('input-birthday', 'icon-check-birthday', null, 10);
      fieldChecker_Load('input-phone', 'icon-check-phone', null, 13);
      fieldChecker_Load('input-address1', 'icon-check-address1', null, 3);
      fieldChecker_Load('input-address2', 'icon-check-address2', null, 3);
      fieldChecker_Load('input-nationality', 'icon-check-nationality', null, 3);
      fieldChecker_Load('input-work', 'icon-check-work', null, 3);
      fieldChecker_Load('input-marital', 'icon-check-marital', null, 3);
      fieldChecker_Load('input-diet', 'icon-check-diet', null, 3);
      fieldChecker_Load('input-sport', 'icon-check-sport', null, 3);
      fieldChecker_Load('input-sleep', 'icon-check-sleep', null, 3);
      fieldChecker_Load('input-diseases', 'icon-check-diseases', null, 3);
      fieldChecker_Load('input-allergies', 'icon-check-allergies', null, 3);
      fieldChecker_Load('input-surgeries', 'icon-check-surgeries', null, 3);
      fieldChecker_Load('input-relatives', 'icon-check-relatives', null, 3);
      fieldChecker_Load('input-notes', 'icon-check-notes', null, 3);

   </script>

</body>

</html>