<?php

    // Datos.
    require_once '../includes/config.php';
    // Messages.
    require_once '../includes/messages.php';

    // FUNCIONES GENERALES
    function GetInfo($path)
    {
        // comprobar que el archivo existe
        if (!is_readable($path)) { return null; }

        $fileContents = file_get_contents($path);
        return json_decode($fileContents);    
    }

    // OBTENER INFORMACIÓN DE RESERVAS
    function BookingGetByPlace($place)
    {
        // Ubicación del archivo
        $filePath = GetPath($place);

        // comprobar que el archivo existe
        if (!is_readable($filePath)) { return null; }

        // Obtener información del archivo
        $jsonContent = file_get_contents($filePath);
        return json_decode($jsonContent);
    }

    // GUARDAR RESERVAS - ESCRIBIR ARCHIVO
    function BookingStore($booking)
    {
        try
        {
            // Ubicación del archivo
            $filePath = GetPath($booking->place);
        
            // Leer el archivo y decodificar el JSON 
            $data = GetInfo($filePath);
        
            // Si recibimos datos vacios hay que crear el archivo.
            if($data === null)
            {
                $data = new stdClass();
                $data->bookings = [];
            }

            // Crear un nuevo stdClass para la reserva
            $newBooking = new stdClass();

            $newBooking->bookingId = $booking->bookingId;
            $newBooking->userId = $booking->userId;
            $newBooking->userEmail = $booking->userEmail;
            $newBooking->startDate = $booking->dateStart;
            $newBooking->endDate = $booking->dateEnd;

            // Añadir el nuevo stdClass a la lista de reservas
            $data->bookings[] = $newBooking;

            // Codificar de nuevo a JSON y escribir al archivo
            $newFileContents = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($filePath, $newFileContents);
        }
        catch (Exception $e)
        {
            throw new Exception(Message_Error_BookingWrite());    
        }
    }

    // ELIMINAR RESERVAS
    function BookingDelete($place, $id)
    {
        // Ubicación del archivo
        $filePath = GetPath($place);

        // Leer el archivo y decodificar el JSON
        $data = GetInfo($filePath);

        // Si recibimos datos vacios, terminamos.
        if($data === null){return;}

        // Buscar el elemento con el bookingId dado y eliminarlo
        foreach ($data->bookings as $index => $booking) 
        {
            if ($booking->bookingId === $id)
            {
                unset($data->bookings[$index]);

                // Reindexar el array para mantener la estructura consistente
                $data->bookings = array_values($data->bookings);
                break;
            }
        }

        // Guardar el JSON modificado de nuevo en el archivo
        $newJsonContent = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($filePath, $newJsonContent);
    }

    // COMPROBAR RESERVAS DEL USUARIO
    function BookingCheckUser($place, $user)
    {
        $infoBookings = BookingGetByPlace($place);

        // Comprobamos que no es null. Podría darse en caso de que el archivo JSON no exista.
        if($infoBookings === null){ return false; }

        foreach ($infoBookings->bookings as $booking) 
        {
            // Comprobar fecha.
            $startDate = new DateTime($booking->startDate);
            $endDate = new DateTime($booking->endDate);
            $now = new DateTime();

            $status = ($now >= $startDate && $now <= $endDate);

            // Si el id está y también la fecha, damos acceso.
            if($booking->userId == $user && $status)
            {
                return true;
            }
        }

        return false;
    }

    // FUNCIONES AUXILIARES
    function GetPath($id)
    {
        switch ($id)
        {
            case Places::AUDITORIO->value: return "../3d-custom/place-auditorio/booking-auditorio.json";
            case Places::EXPOSICIONES->value: return "../3d-custom/place-salaexposiciones/booking-salaexposiciones.json";
            case Places::SALAPRIVADA->value: return "../3d-custom/place-salaprivada/booking-salaprivada.json";
        }
    }

?>