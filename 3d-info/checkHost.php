<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Reservas.
    require_once '../includes/booking.php';

    // Obtener información del encabezado de la petición.
    $headers = getallheaders();
    $userId = isset($headers['user-id']) ? $headers['user-id'] : null;
    $room = isset($headers['room']) ? $headers['room'] : null;

    // Comprobamos que la petición incluye usuario y lugar.
    if(empty($userId)||empty($room))
    {
        http_response_code(400);
    }

    // REALIZAR COMPROBACIONES.
    // Obtener reservas.
    $bookings = Bookings_Get_ByPlace($room);

    // Obtener reservas activas.
    $bookingsActive = array();

    foreach ($bookings->data as $booking) 
    {
        // Comprobamos que la reserva está activa.
        if (DateIntervalCheckCurrent($booking->date_start, $booking->date_end)) 
        { 
            $bookingsActive[] = $booking;
        }
    }

    // Comprobar que el usuario tiene reservas asignadas.
    foreach ($bookingsActive as $booking) 
    {
        if($booking->user_id == $userId)
        {
            // Si encontramos coincidencia retornamos valor correcto.
            http_response_code(200);
            return;
        }
    }

    // Si no hay coincidencias, retornamos error.
    http_response_code(400);
?>