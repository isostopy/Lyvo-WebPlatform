<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Messages.
    require_once '../includes/messages.php';
    // Reservas.
    require_once '../includes/booking.php';

    function Bookings_Store_Test()
    {
        $bookings = Bookings_Get_ByPlace("auditorio");

        $bookingNew = new stdClass();

        $bookingNew->date_start = "22/12/2024";
        $bookingNew->date_end = "23/12/2024";

        $overlapping = "No hay superposición de fechas.";

        foreach($bookings->data as $booking)
        {
            if(BookingCheckoverlapping($bookingNew, $booking))
            {
                $overlapping = "Se produce superposición de fechas.";
            }
        }

        echo $overlapping; 
    }

    // Manejar el envío del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si el botón ha sido presionado
        if (isset($_POST['submit_button'])) {
            // Ejecutar la función al hacer clic en el botón
            Bookings_Store_Test();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Aquí van tus metadatos, enlaces a estilos, etc. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página</title>
</head>
<body>
    <form method="post" action="">
        <!-- Puedes agregar más campos o elementos aquí si es necesario -->
        <input type="submit" name="submit_button" value="Ejecutar Bookings_Get()">
    </form>
</body>
</html>