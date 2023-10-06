<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Usuarios</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

</head>

<!-- Fondo oscuro -->
<body style="background-color: var(--color_2);">
   
   <!-- CONTENEDOR PRINCIPAL -->
   <div id="content">

        <!-- HEADER -->
        <div id="header">

            <!-- LOGO -->
            <img id="logo" src="../assets/images/t_logo_lyvo_white.png" alt="Lyvo">

        </div>

      <!-- PANELS -->
      <div id="panels">

         <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

            <div class="panel-content max-width-300px">

                <!-- Título del panel -->
                <div class="panel-title">
                    <h1 class="text-color-white">Registro de usuarios</h1>
                </div> 

                <div class="margin-bottom-20px"></div>

                <p class="text-color-white">¡Registro completo!</p>

                <div class="margin-bottom-20px"></div>

                <!-- Enlace volver -->
                <div class="panel-sub flex-justify-center">
                    <a class="text-color-white" href="admin_users.php">Volver</a>
                </div>

            </div>

            <div class="lyvo-leaf lyvo-leaf-outline"></div>

         </div>

         <!-- PANEL DERECHO -->
         <div id="panel-right">

            <img src="../assets/images/web-image-02.jpg" alt="Lyvo" class="img-fullsize">

         </div>

      </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

</body>

</html>