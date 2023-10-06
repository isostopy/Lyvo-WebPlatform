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
            echo '<div>';
            echo '    <h2 class="text-color-blue">'. $title . ' ' . $i . '</h2>';
            echo '    <div class="margin-bottom-5px"></div>';
            echo '    <input type="file" name="' . $name . '_' . $i . '" id="' . $name . '_' . $i . '">';
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

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="../assets/js/utilitiesGeneral.js"></script>
    <script src="../assets/js/uploaderFile.js"></script>
    
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

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

                <div class="panel-content max-width-700px">

                    <div class="margin-bottom-10vh"></div>

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Personalización sala exposiciones</h1>
                    </div>  

                    <div class="margin-bottom-20px"></div>

                    <p class="text-color-white">Gestión de personalización del espacio por parte del usuario. Desde este panel se pueden subir las imágenes para personalizar el espacio.</p>

                    <div class="margin-bottom-20px"></div>

                    <!-- FORM -->
                    <form id="uploadForm" action="" method="post">

                        <!-- AUDITORIO -->
                        <div id="CustomAuditorio" style="display: none">

                            <input type="hidden" name="reference" value="<?php echo $placeId?>">

                            <div class="panel-subpanels-container">

                                <div class="panel-sub flex-wrap flex-margin-r20-c20 flex-spaceBetween">

                                    <?php CreateInputs("Auditorio","image_auditorio",3); ?>

                                </div>

                            </div>

                        </div>

                        <!-- SALA EXPOSICIONES -->
                        <div id="CustomSalaexposiciones" style="display: none">

                            <div class="panel-subpanel-container">

                                <input type="hidden" name="reference" value="<?php echo $placeId?>">

                                <div class="panel-subpanels-container">

                                    <div class="panel-sub flex-wrap flex-margin-r10-c10 flex-spaceBetween panel-background-white">

                                        <?php CreateInputs("Sala exposiciones","image_salaexposiciones",12); ?>

                                    </div>
                                
                                </div>

                            </div>

                        </div>

                        <!-- SALA PRIVADA -->
                        <div id="CustomSalaprivada" style="display: none">

                            <div class="panel-subpanel-container">

                                <input type="hidden" name="reference" value="<?php echo $placeId?>">

                                <div class="panel-subpanels-container">

                                    <?php CreateInputs("Sala privada","image_salaprivada",2); ?>

                                </div>

                            </div>

                        </div>

                        <div class="margin-bottom-20px"></div>

                        <div class="panel-sub flex-column panel-background-white overflow-scroll height-100px">

                            <span id="messages" class="msg msg-general">Esperando la carga de imágenes.</span>

                        </div>

                        <div class="margin-bottom-20px"></div>

                        <!-- Esto lo hacemos llamando a JAVA para que la página no se recargue y nos de feedback -->
                        <input type="button" name="submit" value="SUBIR IMÁGENES" class="button-general button-color" onclick="uploadFiles('uploadForm')">

                        <div class="margin-bottom-20px"></div>

                    </form>

                    <div class="margin-bottom-40px"></div>

                </div>

                <!-- Enlace volver -->

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

    <script>

        RemoveElementById("CustomAuditorio","<?php echo $placeId ?>" === "<?php echo Places::AUDITORIO->value ?>");
        RemoveElementById("CustomSalaexposiciones","<?php echo $placeId ?>" === "<?php echo Places::SALAEXPOSICIONES->value ?>");
        RemoveElementById("CustomSalaprivada","<?php echo $placeId ?>" === "<?php echo Places::SALAPRIVADA->value ?>");

    </script>

</body>

</html>