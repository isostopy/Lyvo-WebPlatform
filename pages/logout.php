<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // Eliminamos la información del servidor.
    Logout();
    
?>

<!DOCTYPE html>
<html>
    <head>

    <script>
        
        // Limpiar el almacenamiento local.
        localStorage.clear();

    </script>

    <?php LoadPage('public/welcome.php'); ?>

    </head>
</html>