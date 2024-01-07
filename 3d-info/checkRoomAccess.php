<?php

    /* Resumen

        Sistema de acceso a los espacios mediante contraseña.

        ¿Cuándo tenemos acceso al espacio?
        
        1. Si no hay reserva tenemos acceso total. Retorna 200.
        2. Si hay reserva en el momento de la consulta solo podemos acceder si la contraseña es correcta.
            
            -Correcta. Retorna 200.
            -Incorreta. Retorna 300.

    */

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Reservas.
    require_once '../includes/booking.php';
    // Accesos.
    require_once '../includes/room_access.php';

    // Obtener información del encabezado de la petición.
    $headers = getallheaders();
    $authorization = isset($headers['authorization']) ? $headers['authorization'] : null;
    $room = isset($headers['room']) ? $headers['room'] : null;

    // Comprobamos que la petición incluye lugar.
    if(empty($room))
    {
        http_response_code(403);
        return;
    }

    // REALIZAR COMPROBACIONES.
    // Obtener reservas.
    // Necesitamos obtener las reservas porque si no hay reservas en ese momento damos total acceso.
    $bookings = Bookings_Get_ByPlace($room);

    // Obtener reservas activas.
    $bookingsActive = array();

    foreach ($bookings->data as $booking) 
    {
        // Comprobamos que la reserva está activa en el momento de la consulta.
        if (DateIntervalCheckCurrent($booking->date_start, $booking->date_end)) 
        { 
            $bookingsActive[] = $booking;
        }
    }

    // Si no hay reservas, dar acceso.
    if (empty($bookingsActive)) 
    {
        http_response_code(200);
        return;
    }
    else
    {
        // Si hay reservas determinar según el pass.
        $obj = RoomAccess_Get($room);
        $pass = $obj->data->pass;

        if($pass == $authorization || $pass = null)
        {
            http_response_code(200);
            return;
        }
    }

    // Si no hay coincidencias, retornamos error.
    http_response_code(403);
?>