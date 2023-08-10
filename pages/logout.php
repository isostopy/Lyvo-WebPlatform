<?php

    // Datos.
    require '../includes/config.php';
    // Funcionalidades comunes.
    require '../includes/functions.php';

    // Eliminamos la información del servidor.
    Logout();

    // Eliminamos la información del local storage.
    $welcomePage = GetURL("public/welcome.php");
?>

<!DOCTYPE html>
<html>
    <head>

    <script>
        
            // Limpiar el almacenamiento local.
            localStorage.clear();

            // Cargar la página.
            var urlwelcome = <?php echo json_encode($welcomePage); ?>;

            // Redireccionamos al usuario a la otra página.
            window.location.href = urlwelcome;

    </script>

    </head>
</html>