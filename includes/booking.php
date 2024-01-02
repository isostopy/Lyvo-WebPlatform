<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Messages.
    require_once '../includes/messages.php';


    // OBTENER INFORMACIÓN DE RESERVAS
    function Bookings_Get_ByPlace($place)
    {
        $bearer = $GLOBALS['DirectusToken'];

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        // Las reservas están por separado en Directus.
        $urlBookings = $GLOBALS['URL_DirectusItems']."place_".$place."_bookings";

        // Enviar la solicitud.
        $responseArray = HttpRequest('GET', $urlBookings, $headers);
        $response = $responseArray['response'];

        // Analizar código de la respuesta para comprobar errores, etc.
        $httpcode = $responseArray['httpcode'];
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        return $obj;
    }

    // CREAR RESERVA
    function Bookings_Post($userInfo, $booking)
    {
        UserCheckSession();

        $bearer = $GLOBALS['DirectusToken'];

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        // Las reservas están por separado en Directus.
        $urlUser = $GLOBALS['URL_DirectusBookings']."place_".$booking->place."_bookings";

        // Crear el Body
        $body = array(

            'user_name' => $userInfo->first_name." ".$userInfo->last_name,
            'user_email' => $booking->user_email, 
            'user_id' => $userInfo->id,
            'date_start' => $booking->date_start,
            'date_end' => $booking->date_end,
            'pass' => $booking->pass
        );

        $jsonBody = json_encode($body);

        // Enviar la solicitud.
        $responseArray = HttpRequest('POST', $urlUser, $headers, $jsonBody);
        $response = $responseArray['response'];

        // Analizar código de la respuesta para comprobar errores, etc.
        $httpcode = $responseArray['httpcode'];
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Comprobar y gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_General());
        }

        return $obj;
    }

    // GUARDAR RESERVAS EN CMS
    function BookingStore($bookingNew)
    {
        try
        {
            // 1. Comprobar que el usuario para el que estamos creando la reserva existe.
            $userInfo = UserGetDataByEmail($bookingNew->user_email);

            if(!isset($userInfo))
            {
                throw new Exception(Message_Error_UserNotRegistered());
            }

            // 2. Comprobar que la fecha de inicio es anterior a la de final.
            if(!DateIntervalCheck($bookingNew->date_start, $bookingNew->date_end))
            {
                throw new Exception(Message_Error_Dates());
            };

            // 3. Comprobar que no se solapan las reservas.
            $bookings = Bookings_Get_ByPlace($bookingNew->place);

            foreach($bookings->data as $booking)
            {
                if(BookingCheckoverlapping($bookingNew, $booking))
                {
                    throw new Exception(Message_Error_BookingOverlapping());
                }
            }

            // 4. Reservar.
            Bookings_Post($userInfo, $bookingNew);
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    // ELIMINAR RESERVAS
    function BookingDelete($place, $id)
    {
        try
        {
            $bearer = $GLOBALS['DirectusToken'];

            // Preparar los datos.
            $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

            // Las reservas están por separado en Directus.
            $urlBookings = $GLOBALS['URL_DirectusBookings']."_".$place."/".$id;

            // Enviar la solicitud.
            HttpRequest('DELETE', $urlBookings, $headers);

        }
        catch (Exception $e)
        {
            throw new Exception(Message_Error_General());
        }
    }

    // COMPROBAR SUPERPOSICIÓN DE RESERVAS
    function BookingCheckoverlapping($booking_1, $booking_2)
    {
        // Coversión de fecha, para asegurarnos.
        $convertirFecha = function($fecha) 
        {
            return DateTime::createFromFormat('d/m/Y', $fecha);
        };

        $booking_1_start = $convertirFecha($booking_1->date_start);
        $booking_1_end = $convertirFecha($booking_1->date_end);
        
        $booking_2_start = $convertirFecha($booking_2->date_start);
        $booking_2_end = $convertirFecha($booking_2->date_end);

        // Comprobaciones.
        $check_1 = $booking_1_start <= $booking_2_end && $booking_1_end >= $booking_2_start;
        $check_2 = $booking_2_start <= $booking_1_end && $booking_2_end >= $booking_1_start;

        $result = $check_1 || $check_2;

        // Retorno.
        return $result;
    }

    // COMPROBAR RESERVAS DEL USUARIO
    function BookingCheckUser($place, $user)
    {
        // 1. Obtenemos reservas por lugar.
        $bookings = Bookings_Get_ByPlace($place);

        foreach ($bookings->data as $booking) 
        {
            // Comprobamos que el usuario tiene reserva.
            $valueUser = $booking->user_id == $user;

            // Comprobamos que las fechas están dentro del rango.
            $valueDate = DateIntervalCheckCurrent($booking->date_start, $booking->date_end);

            // Retornamos el valor.
            return $valueUser && $valueDate;
        }
    }
?>