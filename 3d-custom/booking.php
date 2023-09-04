<?php

    // Datos.
    require_once '../includes/config.php';

    // Messages.
    require_once '../includes/messages.php';

    function StoreBooking($booking)
    {
        try
        {
            // Ubicación del archivo
            $filePath = GetPath($booking->place);
        
            // Leer el archivo y decodificar el JSON
            $fileContents = file_get_contents($filePath);
            $data = json_decode($fileContents, true);
        
            // Añadir un nuevo elemento al array
            $newBooking = array(
                "userId" => $booking->userId,
                "userEmail" => $booking->userEmail,
                "startDate" => $booking->dateStart,
                "endDate" => $booking->dateEnd
            );
        
            $data['bookings'][] = $newBooking;
        
            // Codificar de nuevo a JSON y escribir al archivo
            $newFileContents = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($filePath, $newFileContents);
        }
        catch (Exception $e)
        {
            throw new Exception(Message_Error_BookingWrite());    
        }
    }

    // FUNCIONES AUXILIARES
    function GetPath($id)
    {
        switch ($id)
        {
            case Places::AUDITORIO->value: return "../3d-custom/place-auditorio/booking-auditorio.json";
            case Places::SALAEXPOSICIONES->value: return "../3d-custom/place-salaexposiciones/booking-salaexposiciones.json";
            case Places::SALAPRIVADA->value: return "../3d-custom/place-salaprivada/booking-salaprivada.json";
        }
    }

?>