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
   <title>Lyvo Historia</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
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

            <p class="margin-bottom-20px">Queremos conocerte mejor para poderte dar el mejor servicio.</p>
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

      <div id="right-panel"></div>

      <div id="hoja-livo-grande"></div>

      <!-- FOOTER -->
      <?php include_once "../utils/htmlFooter.php"; ?>

   </div>

</body>

</html>