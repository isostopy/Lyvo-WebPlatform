<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Reservas.
    require_once '../includes/booking.php';
    // Mensajes.
    require_once '../includes/messages.php';

    // DEFINICIONES --------------------------------------------------------------------------------

    function RoomAccess_Get($room)
    {
        // Hacer post al sitio y comparar
        $bearer = $GLOBALS['DirectusToken'];

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        // Las reservas están por separado en Directus.
        $urlBookings = $GLOBALS['URL_DirectusItems']."place_".$room."_access";

        // Enviar la solicitud.
        $responseArray = HttpRequest('GET', $urlBookings, $headers);
        $response = $responseArray['response'];

        // Analizar código de la respuesta para comprobar errores, etc.
        $httpcode = $responseArray['httpcode'];
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        if($obj->data->pass)
        {
            return $obj->data->pass;
        }
    }

    function RoomAccess_Set($room, $pass)
    {
        // Hacer post al sitio y comparar
        $bearer = $GLOBALS['DirectusToken'];

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        // Las reservas están por separado en Directus.
        $urlBookings = $GLOBALS['URL_DirectusItems']."place_".$room."_access";

        $body = array(
            'pass' =>  $pass
        );

        $jsonBody = json_encode($body);

        // Enviar la solicitud.
        $responseArray = HttpRequest('PATCH', $urlBookings, $headers, $jsonBody);
        $response = $responseArray['response'];

        // Analizar código de la respuesta para comprobar errores, etc.
        $httpcode = $responseArray['httpcode'];
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_General());
        }

        return $obj;
    }

    // POST --------------------------------------------------------------------------------

    if(isset($_POST['room']))
    {
        $room = $_POST['room'];

        if(isset($_POST['pass']))
        {
            // Si tenemos pass cambiamos la contraseña.
            $pass = $_POST['pass'];
            RoomAccess_Set($room, $pass);

            echo Message_Editor_ChangePass();
        }
        else
        {
            // Si no hay pass devolvemos la contraseña.
            echo RoomAccess_Get($room);
        }

        exit();
    }
?>