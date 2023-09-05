<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Mensajes.
    require_once '../includes/messages.php';
    // Reservas.
    require_once '../3d-custom/booking.php';

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

                        <div class="content-label">

                            <h2>Auditorio 1</h2>

                            <div class="input-icon">

                                <input type="file" name="image_auditorio_1" id="image_auditorio_1">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Auditorio 2</h2>

                            <div class="input-icon">

                                <input type="file" name="image_auditorio_2" id="image_auditorio_2">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Auditorio 3</h2>

                            <div class="input-icon">

                                <input type="file" name="image_auditorio_3" id="image_auditorio_3">

                            </div>

                        </div>

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

                        <div class="content-label">

                            <h2>Sala Exposiciones 1</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaexposiciones_1" id="image_salaexposiciones_1">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Sala Exposiciones 2</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaexposiciones_2" id="image_salaexposiciones_2">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Sala Exposiciones 3</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaexposiciones_3" id="image_salaexposiciones_3">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Sala Exposiciones 4</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaexposiciones_4" id="image_salaexposiciones_4">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Sala Exposiciones 5</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaexposiciones_5" id="image_salaexposiciones_5">

                            </div>

                        </div>

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

                        <div class="content-label">

                            <h2>Sala Privada 1</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaprivada_1" id="image_salaprivada_1">

                            </div>

                        </div>

                        <div class="content-label">

                            <h2>Sala Privada 2</h2>

                            <div class="input-icon">

                                <input type="file" name="image_salaprivada_2" id="image_salaprivada_2">

                            </div>

                        </div>

                        <input type="button" name="submit" value="SUBIR IMÁGENES" class="form-btn margin-bottom-50px" onclick="uploadFiles('uploadForm')">

                        <span id="messages" class="msg msg-error"></span>

                    </form>

                </div>


            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

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

        RemoveElementById("CustomAuditorio","<?php echo $placeId ?>" === "<?php echo Places::AUDITORIO->value ?>");
        RemoveElementById("CustomSalaexposiciones","<?php echo $placeId ?>" === "<?php echo Places::SALAEXPOSICIONES->value ?>");
        RemoveElementById("CustomSalaprivada","<?php echo $placeId ?>" === "<?php echo Places::SALAPRIVADA->value ?>");

    </script>

</body>

</html>