<?php

   // Datos.
   require_once '../includes/config.php';
   // Funcionalidades comunes.
   require_once '../includes/functions.php';
   
   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession();

   // Codificamos los valores para poderlos enviar por URL, por si hay algún caracter especial.
   $idAuditorio = urlencode(Places::AUDITORIO->value);
   $idSalaExposiciones = urlencode(Places::SALAEXPOSICIONES->value);
   $idSalaPrivada = urlencode(Places::SALAPRIVADA->value);

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

               <h1>Andministración de espacios</h1>

               <p>Por favor, elige un espacio para configurar.</p>

               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_assign.php?id=<?php echo $idAuditorio?>' ">AUDITORIO</button>
               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_assign.php?id=<?php echo $idSalaExposiciones?>' ">SALA DE EXPOSICIONES</button>
               <button class ="button-general margin-top-bottom-10px" onclick="location.href = 'admin_place_assign.php?id=<?php echo $idSalaPrivada?>' ">SALA PRIVADA</button>
               
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

</body>

</html>