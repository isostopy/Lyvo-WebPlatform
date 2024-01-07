<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Bookings.
    require_once '../includes/booking.php';
   
    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession();

    // Condiciones
    $showAuditorio = false;
    $showSalaexposiciones = false;
    $showSalaprivada = false;

    // Comprobar y cargar los permisos de edición del usuario.
    if(isset($_SESSION['userData']))
    {
        $info = $_SESSION['userData']->data;

        // Si el usuario es un administrador, redirigimos a la página específica de administración de espacios.
        if($info->role === $GLOBALS['Role_Administrator']){ LoadPage("pages/admin_places.php"); }

        // Obtenemos la id del usuario para compararla con las reservas.
        $userId = $info->id;

        // Obtenemos las reservas para los distintos espacios cargamos los elementos necesarios.
        
        // Auditorio
        $showAuditorio = BookingCheckUser(Places::AUDITORIO->value,$userId);
        // Salaexposiciones
        $showSalaexposiciones = BookingCheckUser(Places::EXPOSICIONES->value,$userId);
        // Salaprivada
        $showSalaprivada = BookingCheckUser(Places::SALAPRIVADA->value,$userId);
    }
    else
    {
        LoadPage("public/login_form_editor.php");
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

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Administración de espacios</h1>
                    </div> 

                    <div class="margin-bottom-40px"></div>

                    <?php
                        // El usuario tiene permisos para editar el auditorio.
                        if($showAuditorio) 
                        {
                            echo '<button class="button-general button-color" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::AUDITORIO->value) . '\'">AUDITORIO</button>'; 
                            echo '<div class="margin-bottom-20px"></div>';
                        }

                        // El usuario tiene permisos para editar la sala de exposiciones.
                        if($showSalaexposiciones) 
                        {
                            echo '<button class="button-general button-color" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::EXPOSICIONES->value) . '\'">SALA DE EXPOSICIONES</button>'; 
                            echo '<div class="margin-bottom-20px"></div>';
                        } 

                        // El usuario tiene permisos para editar la sala privada.
                        if($showSalaprivada) 
                        {
                            echo '<button class="button-general button-color" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::SALAPRIVADA->value) . '\'">SALA PRIVADA</button>'; 
                            echo '<div class="margin-bottom-20px"></div>';
                        }

                        // El usuario no tiene ningún permiso.
                        if(!$showAuditorio && !$showSalaexposiciones && !$showSalaprivada)
                        {
                            echo '<p class="text-color-white">Lo sentimos, no dispone de permisos de edición en este momento.</p>';
                            echo '<div class="margin-bottom-20px"></div>';
                        }
                    ?>

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