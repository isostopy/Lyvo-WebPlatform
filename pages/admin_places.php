<?php

   // Datos.
   require_once '../includes/config.php';
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession(UserType::ADMINISTRATOR->value);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Config</title>
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

               <h1>Administración de espacios</h1>

               <p>Por favor, elige un espacio para configurar.</p>

               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_booking.php?placeId=<?php echo urlencode(Places::AUDITORIO->value);?>' ">AUDITORIO</button>
               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_booking.php?placeId=<?php echo urlencode(Places::SALAEXPOSICIONES->value);?>' ">SALA DE EXPOSICIONES</button>
               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_booking.php?placeId=<?php echo urlencode(Places::SALAPRIVADA->value);?>' ">SALA PRIVADA</button>
               
            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>

</body>

</html>