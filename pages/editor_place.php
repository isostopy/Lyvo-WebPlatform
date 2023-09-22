<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Mensajes.
    require_once '../includes/messages.php';
    // Reservas.
    require_once '../includes/booking.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession();

    // Obtener valor del lugar de la ID.
    $placeId = PlaceGetFromURL();

    // Comprobar que el usuario tiene permisos de edición.
    if($_SESSION['userData']->data->id)
    {
        $userData = $_SESSION['userData']->data;

        $userId = $userData->id;
        $userRole = $userData->role;

        if($userRole !== RoleTranslatorByName(UserType::ADMINISTRATOR->value))
        {
            if(!BookingCheckUser($placeId, $userId))
            {
                LoadPage("errors/404.php");
            }
        }
    }
    else
    {
        LoadPage("public/login_form.php");
    }

    function CreateInputs($title, $name, $items) 
    {
        for ($i = 1; $i <= $items; $i++) {
            echo '<div class="content-label">';
            echo '    <h2>'. $title . ' ' . $i . '</h2>';
            echo '    <div class="input-icon">';
            echo '        <input type="file" name="' . $name . '_' . $i . '" id="' . $name . '_' . $i . '">';
            echo '    </div>';
            echo '</div>';
        }
    }  
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="../assets/js/utilitiesGeneral.js"></script>
    <script src="../assets/js/uploaderFile.js"></script>
    
</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

                <!-- AUDITORIO -->
                <div id="CustomAuditorio" style="display: none">

                    <h1>Personalización Auditorio</h1>

                    <p class="margin-bottom-30px">Gestión de personalización del espacio por parte del usuario. Desde este panel se pueden subir las imágenes para personalizar el espacio.</p>

                    <form id="uploadForm" action="" method="post">

                        <input type="hidden" name="reference" value="<?php echo $placeId?>">

                        <?php CreateInputs("Auditorio","image_auditorio",3); ?>

                        <input type="button" name="submit" value="SUBIR IMÁGENES" class="form-btn margin-bottom-50px" onclick="uploadFiles('uploadForm')">

                        <span id="messages" class="msg msg-error"></span>

                    </form>

                </div>

                <!-- SALA EXPOSICIONES -->
                <div id="CustomSalaexposiciones" style="display: none">

                    <h1>Personalización Sala Exposiciones</h1>

                    <p class="margin-bottom-30px">Gestión de personalización del espacio por parte del usuario. Desde este panel se pueden subir las imágenes para personalizar el espacio.</p>

                    <form id="uploadForm" action="" method="post">

                        <input type="hidden" name="reference" value="<?php echo $placeId?>">

                        <?php CreateInputs("Sala exposiciones","image_salaexposiciones",12); ?>

                        <input type="button" name="submit" value="SUBIR IMÁGENES" class="form-btn margin-bottom-50px" onclick="uploadFiles('uploadForm')">

                        <span id="messages" class="msg msg-error"></span>

                    </form>

                </div>

                <!-- SALA PRIVADA -->
                <div id="CustomSalaprivada" style="display: none">

                    <h1>Personalización Sala Privada</h1>

                    <p class="margin-bottom-30px">Gestión de personalización del espacio por parte del usuario. Desde este panel se pueden subir las imágenes para personalizar el espacio.</p>

                    <form id="uploadForm" action="" method="post">

                        <input type="hidden" name="reference" value="<?php echo $placeId?>">

                        <?php CreateInputs("Sala privada","image_salaprivada",2); ?>

                        <input type="button" name="submit" value="SUBIR IMÁGENES" class="form-btn margin-bottom-50px" onclick="uploadFiles('uploadForm')">

                        <span id="messages" class="msg msg-error"></span>

                    </form>

                </div>


            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>

    <script>

        RemoveElementById("CustomAuditorio","<?php echo $placeId ?>" === "<?php echo Places::AUDITORIO->value ?>");
        RemoveElementById("CustomSalaexposiciones","<?php echo $placeId ?>" === "<?php echo Places::SALAEXPOSICIONES->value ?>");
        RemoveElementById("CustomSalaprivada","<?php echo $placeId ?>" === "<?php echo Places::SALAPRIVADA->value ?>");

    </script>

</body>

</html>