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
        $showSalaexposiciones = BookingCheckUser(Places::SALAEXPOSICIONES->value,$userId);
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

                <?php
                    // El usuario tiene permisos para editar el auditorio.
                    if($showAuditorio) 
                    {
                        echo '<button class="button-general margin-top-bottom-10px" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::AUDITORIO->value) . '\'">AUDITORIO</button>'; 
                    }

                    // El usuario tiene permisos para editar la sala de exposiciones.
                    if($showSalaexposiciones) 
                    {
                        echo '<button class="button-general margin-top-bottom-10px" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::SALAEXPOSICIONES->value) . '\'">SALA DE EXPOSICIONES</button>'; 
                    } 

                    // El usuario tiene permisos para editar la sala privada.
                    if($showSalaprivada) 
                    {
                        echo '<button class="button-general margin-top-bottom-10px" onclick="location.href = \'editor_place.php?placeId=' . urlencode(Places::SALAPRIVADA->value) . '\'">SALA PRIVADA</button>'; 
                    }

                    // El usuario no tiene ningún permiso.
                    if(!$showAuditorio && !$showSalaexposiciones && !$showSalaprivada)
                    {
                        echo '<p>Lo sentimos, no dispone de permisos de edición en este momento.</p>';
                    }
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