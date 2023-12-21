<?php

   // Requerimos la configuración para iniciar sesión.
   require_once '../includes/config.php';

   // Recopilar toda la información necesaria para enviar al 3D.
   $id = "No registrado";
   $user_name = "No registrado";
   $avatar = "avatar-1";
   $email = "No registrado";
   

   $showTravelScreen = false;

   // 1. AVATAR
   if(isset($_SESSION['avatarSelected']))
   {
      $avatar = $_SESSION['avatarSelected'];
   }
   else
   {
      // Si no tenemos avatar seleccionado, porque el usuario vuelve directamente del login,
      // es decir, lo seleccionó en su momento y el programa salta.
      if(isset($_SESSION['userData']->data->AvatarInformation->type))
      {
         $avatar = $_SESSION['userData']->data->AvatarInformation->type;
      }
   }

   // Si no se da ninguna de las condiciones anteriores, ponemos el avatar por defecto.


   // 2. NOMBRE DEL USUARIO
   // Si el usuario está registrado cogemos su nombre de sus datos.
   if(isset($_SESSION['userData'])) 
   {
      $id = $_SESSION['userData']->data->id;
      $user_name = $_SESSION['userData']->data->first_name;
      $email = $_SESSION['userData']->data->email;
   }
   // Si no está registrado, cogemos el nombre de los datos proporcionados al crear el avatar.
   else
   {
      if(isset($_SESSION['nameSelected']))
      {
         $user_name = $_SESSION['nameSelected'];
      }
   }

   // Comprobamos si hay que mostrar o no la página de "Todo listo".
   if(isset($_SESSION['medicalInfoFirstTime']))
   {
      if($_SESSION['medicalInfoFirstTime'])
      {
         $showTravelScreen = true;

         // Una vez utilizado el valor lo ponemos a negativo para evitar
         // que si volvemos del metaverso durante la misma sesión, vuelva a saltar.
         $_SESSION['medicalInfoFirstTime'] = false;
      }
   }

   // PREPARAR INFORMACIÓN
   $userData = array(
      "user-id" => $id,
      "user-name" => $user_name,
      "avatar-id" => $avatar,
      "email" => $email
   );
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo 3D</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
   <script>
      
      function loadMetaverse()
      {
         // Obtenemos los datos del usuario.
         var userData = <?php echo json_encode($userData); ?>;
         var url3d = <?php echo json_encode($URL_Lyvo3D); ?>;

         for (var key in userData) 
         {
            localStorage.setItem(key, userData[key]);
         }

         var avatarId = localStorage.getItem("avatar-id");
         var userName = localStorage.getItem("user-name");
         var userEmail = localStorage.getItem("email");

         // Redireccionamos al usuario a la otra página.
         window.location.href = url3d;
      }

      var travelScreen = <?php echo $showTravelScreen ? 'true' : 'false'; ?>;

      if(!travelScreen)
      {
         loadMetaverse();
      }

   </script>

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

         <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

            <div class="panel-content max-width-400px">

               <!-- Título del panel -->
               <div class="panel-title">
                  <h1 class="text-color-blue">¡Todo listo!</h1>
               </div>  

               <div class="margin-bottom-40px"></div>

               <p>Ya está todo preparado para que descrubras el increible universo de Lyvo.</p>
               <div class="margin-bottom-10px"></div>
               <p>Explora cada rincón para encontrar todas sus sorpresas.</p>

               <div class="margin-bottom-20px"></div>

               <button class ="button-general button-color" id="travel-button" >Viajar</button>

            </div>

            <div class="lyvo-leaf lyvo-leaf-solid"></div>

         </div>

         <!-- PANEL DERECHO -->
         <div id="panel-right">

            <img src="../assets/images/web-image-01.jpg" alt="Lyvo" class="img-fullsize">

         </div>

      </div>

      </div>                       

         <!-- FOOTER -->
         <?php include_once "../utils/htmlFooter_Dark.php"; ?>

      </div>

   </div>

   <script>

      var travelButton = document.getElementById('travel-button');

      travelButton.addEventListener('click', function() { loadMetaverse(); });

   </script>

</body>

</html>