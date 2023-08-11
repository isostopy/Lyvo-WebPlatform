<?php

   // Requerimos la configuración para iniciar sesión.
   require '../includes/config.php';

   // Recopilar toda la información necesaria para enviar al 3D.
   $avatar = "avatar-1";
   $user_name = "No registrado";
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
         $email = $_SESSION['userData']->data->email;
      }
   }

   // Si no se da ninguna de las condiciones anteriores, ponemos el avatar por defecto.


   // 2. NOMBRE DEL USUARIO
   // Si el usuario está registrado cogemos su nombre de sus datos.
   if(isset($_SESSION['userData'])) 
   {
      $user_name = $_SESSION['userData']->data->first_name;
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
      "avatar-id" => $avatar,
      "user-name" => $user_name,
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
    <link rel="stylesheet" href="../assets/css/lyvo_style.css">
    <link rel="stylesheet" href="../assets/css/login_form.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
   <script>
      
      function loadMetaverse()
      {
         // Obtenemos los datos del usuario.
         var userData = <?php echo json_encode($userData); ?>;
         var url3d = <?php echo json_encode($URL_Lyvo3D); ?>;

         for (var key in userData) {
            localStorage.setItem(key, userData[key]);
         }

         var avatarId = localStorage.getItem("avatar-id");
         var userName = localStorage.getItem("user-name");
         var userName = localStorage.getItem("email");
   
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

    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

               <h1>¡Todo listo!</h1>

               <div class="content-main margin-bottom-20px" id="page_1">

                  <div id="texto-izquierda">

                     <p>Ya está todo preparado para que descrubras el increible universo de Lyvo. Explora cada rincón para encontrar todas sus sorpresas.</p>
   
                  </div>
               
               </div>

               <button class ="button-general margin-top-bottom-10px" id="travel-button" >VIAJAR</button>

            </div>

        </div>

        <div id="right-panel">
        </div>

        <div id="hoja-livo-grande">
        </div>

        <div id="textos-inferiores">
            <div id="copyright">
                <p>Copyright 2023© All rights reserved</p>
            </div>

            <div id="botones-esquina">
                <div id="politica-privacidad">
                    <a href="../public/privacy.html">Política de privacidad</a>
                </div>

                <div id="cookies">
                    <a href="../public/privacy.html">Aviso de cookies</a>
                </div>
            </div>
        </div>

    </div>

    <script>

      var travelButton = document.getElementById('travel-button');

      travelButton.addEventListener('click', function() { loadMetaverse(); });

   </script>

</body>

</html>