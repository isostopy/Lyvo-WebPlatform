<?php

    //*******************************************************************
    // PHP con la funcionalidad general de la aplicación.
    //*******************************************************************

    // RECURSOS -----------------------------------------------------------------------------

    // Datos.
    require_once 'config.php';
    // Funcionalidades comunes.
    require_once 'email.php';
    // Mensajes.
    require_once 'messages.php';

    // FUNCIONES -----------------------------------------------------------------------------
 
    // ---------------------------------------------------------------------------------------------------------------------------------------
    // PETICIONES ----------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // SISTEMA GENERAL PARA REALIZAR PETICIONES DEVUELVE LA RESPUESTA Y EL CÓDIGO EN FORMA DE ARRAY.
    function HttpRequest($mode, $url, $headers, $data=null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $mode,
            CURLOPT_HTTPHEADER => $headers
        ));

        // Añadir body si no es nulo.
        if ($data !== null) 
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // Realizar la petición.
        $response = curl_exec($curl);

        // Obtener el código de estado HTTP.
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Gestión de errores generales, por ejemplo una pérdida de conexión.
        if (curl_errno($curl)) 
        {
            //$error = curl_error($curl); // En caso de querer conocer el error.
            curl_close($curl);
            throw new Exception(Message_Error_General());
        }

        curl_close($curl);

        return array('response' => $response, 'httpcode' => $httpcode);
    }

    // EL SISTEMA DE ANÁLISIS DE CÓDIGOS FUNCIONA EXCLUSIVAMENTE PARA LA API DE DIRECTUS.

    // SISTEMA GENERAL PARA ANALIZAR CÓDIGOS.
    function HttpRequestCodeAnalyzer($response, $httpcode)
    {
        // Código 204 No Content
        if($httpcode === 204)
        {
            return;
        }

        // Código 400
        else if ($httpcode === 400) 
        {   
            HttpRequestCodeAnalyzer_400($response);
        }

        // Código401
        else if($httpcode === 401)
        {
            HttpRequestCodeAnalyzer_401($response);
        }

        // Código >400
        else if ($httpcode >= 401) 
        {
            throw new Exception(Message_Error_General());
        }

        // General
        else
        {
            return;
        }
    }
    
    // SISTEMA GENERAL PARA ANALIZAR CÓDIGOS 401 NO AUTORIZADOS POR CREDENCIALES INVÁLIDOS O TOKEN EXPIRADO.
    function HttpRequestCodeAnalyzer_400($response)
    {
        $decodedResponse = json_decode($response);

        // Comprobamos que hay respuesta.
        if (!isset($decodedResponse->errors[0]->extensions->code)) 
        {
            throw new Exception(Message_Error_General());
        }
        
        // Si hay respuesta, analizamos el código.
        $code = $decodedResponse->errors[0]->extensions->code;
        
        switch ($code) 
        {
            case 'RECORD_NOT_UNIQUE':

                // Cargamos la pantalla de sesión expirada.
                throw new Exception(Message_Error_Register());
                break;

            default:

                // Lanzamos error de credenciales inválidos
                throw new Exception(Message_Error_General());
                break;
        }
    }

    // SISTEMA GENERAL PARA ANALIZAR CÓDIGOS 401 NO AUTORIZADOS POR CREDENCIALES INVÁLIDOS O TOKEN EXPIRADO.
    function HttpRequestCodeAnalyzer_401($response)
    {
        $decodedResponse = json_decode($response);

        // Comprobamos que hay respuesta.
        if (!isset($decodedResponse->errors[0]->extensions->code)) 
        {
            throw new Exception(Message_Error_General());
        }
        
        // Si hay respuesta, analizamos el código.
        $code = $decodedResponse->errors[0]->extensions->code;
        
        switch ($code) 
        {
            case 'TOKEN_EXPIRED':

                // Cargamos la pantalla de sesión expirada.
                LoadPage("pages/session_expired.php");

                break;

            case 'INVALID_CREDENTIALS':

                // Lanzamos error de credenciales inválidos
                throw new Exception(Message_Error_Unauthorized());
                break;

            default:

                // Lanzamos error de credenciales inválidos
                throw new Exception(Message_Error_General());
                break;
        }
    }



    // ---------------------------------------------------------------------------------------------------------------------------------------
    // REGISTRO ------------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // REGISTRO
    // Por defecto introducimos los valores para el registro del cliente que no selecciona ni su tipo de usuario ni su estado.
    function Register($user_Name, $user_LastName, $user_Email, $user_Password, $user_Role, $status, $sendEmail)
    {
        // Traducimos el nombre del role al código correspondiente.
        $user_Role_Code = RoleTranslatorByName($user_Role);

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);
        $body = array(
            'email' =>  $user_Email, 
            'password' => $user_Password,
            'first_name' => $user_Name,
            'last_name' => $user_LastName,
            'role' => $user_Role_Code,
            'status' => $status
        );

        $jsonBody = json_encode($body);

        // Enviar la solicitud.
        $responseArray = HttpRequest('POST', $GLOBALS['URL_DirectusUsers'], $headers, $jsonBody);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        // Si no hay errores, continuamos y obtenemos los datos de la respuesta.
        $obj = json_decode($response);

        // Gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_Register());
        }

        // Enviar email de confirmación en caso de que el registro no lo esté haciendo directamente el administrador.
        if($sendEmail)
        {
            ConfirmEmailSend($obj->data);
        }
    }

    // CONFIRMAR EMAIL
    function ConfirmEmailSend($userInfo)
    {
        $userId = $userInfo->id;

        $userEmail = $userInfo->email;
        $subject = Email_Register_Subject();
        $body = Email_Register_Body().$GLOBALS['URL_Base'].$GLOBALS['URL_Partial_Validation'].$userId;
        $bodyNonHTML = Email_Register_BodyNonHtml().$GLOBALS['URL_Base'].$GLOBALS['URL_Partial_Validation'].$userId;

        SendEmail($userEmail, $subject, $body, $bodyNonHTML);
    }

    // CONFIRMAR EMAIL
    function UserValidate($userId)
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);
        $body = array( 'status' =>  UserStatus::ACTIVE );

        $jsonBody = json_encode($body);

        $urlUser = $GLOBALS['URL_DirectusUsers']."/".$userId;

        // Enviar la solicitud.
        $responseArray = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_Register());
        }

        // Comprobar que el estado del usuario se ha ajustado correctamente.
        if($obj->data->status !== "active")
        {
            throw new Exception(Message_Error_Register());
        }
    }

    // ELIMINAR USUARIO
    function UserDelete($userId)
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);

        // Enviar la solicitud.
        try
        {
            HttpRequest('DELETE', $GLOBALS['URL_DirectusUsers']."/".$userId, $headers);
        }
        catch(Exception $e)
        {
            throw new Exception(Message_Error_Delete());
        }

        // No hay respuesta, Directus elimina al usuario y devuelve 204 No Content.
    }


    // ---------------------------------------------------------------------------------------------------------------------------------------
    // AUTENTICACIÓN -------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // AUTENTICACIÓN
    function Authenticate($user_Email, $user_Password)
    {
        $headers = array('Content-Type: application/json');
        $credentials = array('email' =>  $user_Email, 'password' => $user_Password);
        $jsonCredentials = json_encode($credentials);

        // Enviar la solicitud.
        $responseArray = HttpRequest('POST', $GLOBALS['URL_DirectusLogin'], $headers, $jsonCredentials);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        // Gestionar la respuesta.
        $obj = json_decode($responseArray['response']);

        // Comprobar que recibimos token y token de refresco.
        if (!isset($obj->data->access_token, $obj->data->refresh_token)) 
        {
            throw new Exception(Message_Error_Unauthorized());
        }
        else
        {
            // Almacenar el token en la sesión.
            $_SESSION['userAccessToken'] = $obj->data;
        }
    }

    // REFRESH TOKEN
    function Authenticate_Refresh()
    {
        // Comprobar que disponemos de token de refresco.
        $refresh_Token = GetStoredToken('refresh_token');

        $headers = array('Content-Type: application/json');
        $refreshInfo = array('refresh_token' =>  $refresh_Token, 'mode' => 'json');
        $jsonRefreshInfo = json_encode($refreshInfo);

        // Enviar la solicitud.
        $responseArray = HttpRequest('POST', $GLOBALS['URL_DirectusRefresh'], $headers, $jsonRefreshInfo);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        // Gestionar la respuesta.
        $obj = json_decode($response);

        if (!isset($obj->data->access_token, $obj->data->refresh_token)) 
        {
            return false;
        }
        else
        {
            $_SESSION['userAccessToken'] = $obj->data;
            return true;
        }
    }
    
    // LOGOUT
    function Logout()
    {
        // 1. Cerrar sesión en Directus si tenemos token de refresco. Invalidar refresh token.
        if(isset($_SESSION['userAccessToken']->refresh_token))
        {
            $headers = array('Content-Type: application/json');
            $credentials = array('refresh_token' => $_SESSION['userAccessToken']->refresh_token);
            $jsonCredentials = json_encode($credentials);
    
            // Enviar la solicitud.
            HttpRequest('POST', $GLOBALS['URL_DirectusLogout'], $headers, $jsonCredentials);
        }

        // 2. Cerrar sesión en el servidor.
        // Iniciar la sesión. No importa si ya está iniciada.
        session_start();

        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Destruir la sesión cookie.
        if (ini_get("session.use_cookies")) 
        {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
    }



    // ---------------------------------------------------------------------------------------------------------------------------------------
    // PASS ACTIONS --------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // RECOVER PASS REQUEST
    function UserRecoverPassRequest($email)
    {      
        $headers = array('Content-Type: application/json');
        $credentials = array('email' =>  $email, 'reset_url' => $GLOBALS['URL_RecoverPass']);
        $jsonCredentials = json_encode($credentials);
  
        // Enviar la solicitud.
        HttpRequest('POST', $GLOBALS['URL_DirectusRecoverPass_Request'], $headers, $jsonCredentials);

        // No hay respuesta, Directus envía el correo y devuelve 204 No Content.
    }

    // RECOVER PASS RESET
    function UserRecoverPassSet($token, $pass)
    {
        $headers = array('Content-Type: application/json');
        $credentials = array('token' =>  $token, 'password' => $pass);
        $jsonCredentials = json_encode($credentials);
  
        // Enviar la solicitud.
        HttpRequest('POST', $GLOBALS['URL_DirectusRecoverPass_Reset'], $headers, $jsonCredentials);

        // No hay respuesta, Directus envía el correo y devuelve 204 No Content.
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // USER INFORMATION ----------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // OBTENER INFORMACIÓN DE SESIÓN DEL USUARIO
    function GetStoredToken($value)
    {
        // Comprobar que disponemos de tokens.
        if (!isset($_SESSION['userAccessToken']))
        {
            // Si no hay token de refresco, nos vamos a la página de sesión expirada.
            LoadPage("pages/session_expired.php");
        }

        try
        {
            switch ($value) 
            {
                case 'access_token': return $_SESSION['userAccessToken']->access_token;
                case 'refresh_token': return $_SESSION['userAccessToken']->refresh_token;
            }
        }
        catch (Exception $e)
        {
            LoadPage("pages/session_expired.php");
        }
    }

    function UserGetTokenStatus()
    {
        // Hacemos un user/me para comprobar la validez del token.
        // Comprobamos y obtenemos el token de acceso.
        $access_Token = GetStoredToken('access_token');

        $headers = array('Content-Type: application/json','Authorization: Bearer '.$access_Token);

        $responseArray = HttpRequest('GET', $GLOBALS['URL_DirectusUsersMe'], $headers);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Gestionar errores de acceso no autorizado.
        if($httpcode == 401)
        {
            $decodedResponse = json_decode($response);

            // Comprobamos que hay respuesta.
            if (!isset($decodedResponse->errors[0]->extensions->code)) 
            {
                return false;
            }
            
            // Si hay respuesta, analizamos el código.
            $code = $decodedResponse->errors[0]->extensions->code;
            
            switch ($code) 
            {
                case 'TOKEN_EXPIRED':

                    return Authenticate_Refresh();

                    break;

                case 'INVALID_CREDENTIALS':

                    return false;
                    break;

                default:

                    return false;
                    break;
            }
        }

        // Verificar el código de estado HTTP.
        else if ($httpcode >= 400) 
        {
            return false;
        }

        // Si todo es correcto devolvemos true;
        else
        {
            return true;
        }
    }

    // OBTENER INFORMACIÓN DEL USUARIO
    function UserGetData()
    {
        // Comprobamos y obtenemos el token de acceso.
        $access_Token = GetStoredToken('access_token');

        $headers = array('Content-Type: application/json','Authorization: Bearer '.$access_Token);

        $responseArray = HttpRequest('GET', $GLOBALS['URL_DirectusUsersMe'], $headers);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Comprobamos que la respuesta tiene datos válidos.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_InfoGet());
        }

        $_SESSION['userData'] = $obj;
    }

    // OBTENER INFORMACIÓN DE TODOS LOS USUARIOS
    function UserGetDataAll()
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);

        // Enviar la solicitud.
        $responseArray = HttpRequest('GET', $GLOBALS['URL_DirectusUsers'], $headers);
        $response = $responseArray['response'];
        $httpcode = $responseArray['httpcode'];

        // Analizar código de la respuesta para comprobar errores, etc.
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Comprobamos que la respuesta tiene datos válidos.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_InfoGet());
        }

        // Devolver la información.
        else
        {
            return $obj;
        }
    }

    // COMPROBAR QUE EL USUARIO ESTÁ REGISTRADO
    // De todos los usuarios, retorna la información del indicado por el email.
    function UserGetDataByEmail($email)
    {
        // Obtenemos la información de todos los usuarios.
        $users = UserGetDataAll();

        // Retornamos la información del usuario indicado.
        return UserGetByEmail($users, $email);
    }

    // OBTENER INFORMACIÓN DEL USUARIO A PARTIR DE TODOS
    // De todos los usuarios, retorna la información del indicado por el id.
    function UserGetDataById($user_id)
    {
        $obj = UserGetDataAll();

        // Obtenemos la información específica del usuario
        $userInfo = UserGetById($obj, $user_id);

        // Comprobamos que el usuario tiene información válida
        if (!isset($userInfo->MedicalInformation)) 
        {
            // El usuario tiene información médica pero corresponde con información "saltada".
            if($userInfo->MedicalInformation == "skipped")
            {
                throw new Exception(Message_Error_InfoMedNo());
            } 
        }

        return $userInfo;
    }

    // OBTENER INFORMACIÓN DEL USUARIO A PARTIR DE UN STDCLASS CON TODOS LOS USUARIOS MEDIANTE EL ID
    function UserGetById($stdClass, $id) 
    {
        foreach ($stdClass->data as $user) 
        {
            if ($user->id == $id) 
            {
                return $user;
            }
        }
    
        return null;
    }

    // OBTENER INFORMACIÓN DEL USUARIO A PARTIR DE UN STDCLASS CON TODOS LOS USUARIOS MEDIANTE EL EMAIL
    function UserGetByEmail($stdClass, $email) 
    {
        foreach ($stdClass->data as $user) 
        {
            if ($user->email == $email) 
            {
                return $user;
            }
        }
    
        return null;
    }

    // TRADUCTOR DE ROLES
    function RoleTranslatorById($roleId)
    {
        switch ($roleId)
        {
            case $GLOBALS['Role_Administrator']: return UserType::ADMINISTRATOR->value;
            case $GLOBALS['Role_Company']: return UserType::COMPANY->value;
            case $GLOBALS['Role_Professional']: return UserType::PROFESSIONAL->value;
            case $GLOBALS['Role_Client']: return UserType::CLIENT->value;
            default: return UserType::UNDEFINED->value;
        }
    }

    function RoleTranslatorByName($roleName)
    {
        switch ($roleName)
        {
            case UserType::ADMINISTRATOR->value: return $GLOBALS['Role_Administrator'];
            case UserType::COMPANY->value: return $GLOBALS['Role_Company'];
            case UserType::PROFESSIONAL->value: return $GLOBALS['Role_Professional'];
            case UserType::CLIENT->value: return $GLOBALS['Role_Client'];
            default: return "";
        }
    }

    // COMPROBAR LA SESIÓN
    // Utilizando los parámetros podemos comprobar también el rol del usuario.
    function UserCheckSession($role=null)
    {
        // Si no hay una sesión iniciada, cargar welcome.
        if(!isset($_SESSION['userAccessToken']->access_token))
        {
            LoadPage("public/welcome.php");
        }

        // Si hay abierta una sesión, comprobar que el token es válido.
        else
        {
            // Si no conseguimos un token correcto, enviamos al usuario a la página de sesión caducada.
            if(!UserGetTokenStatus())
            {
                LoadPage("pages/session_expired.php");
            }

            // Si hay un rol introducido, comprobamos que el usuario corresponde con este rol.
            if(!$role){ return; }

            if($_SESSION['userData']->data->role !== RoleTranslatorByName($role))
            {
                LoadPage("errors/404.php");
            }
        } 
    }

    // COMPROBAR QUE EL USUARIO ESTÁ REGISTRADO
    function UserCheckExistenceByEmail($email)
    {
        $users = UserGetDataAll();

        // Recorrer el array de datos
        foreach ($users->data as $user) 
        {
            if ($user->email == $email) 
            {   
                // El email existe.
                return true;
            }
        }

        // El email no existe.
        return false;
    }

    // MOFIDICAR INFORMACIÓN DE USUARIO
    function UserSaveData($user_id, $jsonBody)
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);

        $urlUser = $GLOBALS['URL_DirectusUsers']."/".$user_id;


        // Enviar la solicitud.
        $responseArray = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);
        $response = $responseArray['response'];

        // Analizar código de la respuesta para comprobar errores, etc.
        $httpcode = $responseArray['httpcode'];
        HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Comprobar y gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception(Message_Error_InfoSave());
        }
    }

    // GUARDAR AVATAR
    function UserAvatarSave($avatar)
    {
        // Comprobar la sesión.
        UserCheckSession();

        $bearer = $_SESSION['userAccessToken']->access_token;

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);
        $body = array('AvatarInformation' => array('type' => $avatar));

        $jsonBody = json_encode($body);

        $urlUser = $GLOBALS['URL_DirectusUsersMe'];

        // Enviar la solicitud.
        $responseArray = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);
        $response = $responseArray['response'];
        
        // Analizar código de la respuesta para comprobar errores, etc.
        //$httpcode = $responseArray['httpcode'];
        // HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Gestionar la respuesta.
        if (!isset($obj->data) || !$obj->data->AvatarInformation) 
        {
            throw new Exception(Message_Error_InfoSave());
        }

        // Guardar la nueva información en la sesión.
        $_SESSION['userData'] = $obj;
    }

    // GUARDAR INFORMACIÓN MÉDICA
    // La variable de información tiene que venir codificada en JSON.
    function UserMedicalInformationSave($jsonBody)
    {
        // Comprobar la sesión.
        UserCheckSession();

        $bearer = $_SESSION['userAccessToken']->access_token;

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        $urlUser = $GLOBALS['URL_DirectusUsersMe'];

        // Enviar la solicitud.
        $responseArray = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);
        $response = $responseArray['response'];
        
        // Analizar código de la respuesta para comprobar errores, etc.
        //$httpcode = $responseArray['httpcode'];
        // HttpRequestCodeAnalyzer($response, $httpcode);

        $obj = json_decode($response);

        // Comprobar y gestionar la respuesta.
        if (!isset($obj->data) || !$obj->data->MedicalInformation) 
        {
            throw new Exception(Message_Error_InfoSave());
        }

        // Guardar la nueva información en la sesión.
        $_SESSION['userData'] = $obj;
    }



    // ---------------------------------------------------------------------------------------------------------------------------------------
    // PAGES ---------------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // OBTENER DIRECCIÓN ABSOLUTA
    function GetURL($endUrl)
    {
        return $GLOBALS['URL_Base']."/".$endUrl;
    }

    // CARGAR PÁGINA
    function LoadPage($page)
    {
        header("Location: ".$GLOBALS['URL_Base']."/".$page);
        exit();
    }

    // ABRIR ESCENARIO 3D
    function LoadPage3D($variables)
    {
        header("Location: ".$GLOBALS['URL_Lyvo3D']."/?".$variables);
        exit();
    }

    // CARGAR ESCENA DEPENDIENDO DEL USUARIO
    function LoadPageByUserRole($userRole)
    {
        switch ($userRole)
        {
            // Cliente
            case $GLOBALS['Role_Client']: LoadPage("pages/role_page_client.php"); break;
            // Médico
            case $GLOBALS['Role_Professional']: LoadPage("pages/role_page_professional.php"); break;
            // Administrador
            case $GLOBALS['Role_Administrator']: LoadPage("pages/role_page_admin.php"); break;
            // Default
            default: LoadPage("public/login_form.php"); break;
        }
    }

    // CARGAR PÁGINA DEPENDIENDO DE LA INFORMACIÓN DEL USUARIO
    function LoadPageByUserData()
    {
        // 1. Comprobamos si tiene avatar.
        if (!isset($_SESSION['userData']->data->AvatarInformation)) 
        {
            LoadPage("public/avatar.php");
        }
        // 2. Comprobamos si tiene historia médica.
        else if(!isset($_SESSION['userData']->data->MedicalInformation))
        {
            LoadPage("pages/medicalInformation_launcher.php");
        }
        // 3. Si tiene todo, vamos al 3d launcher.
        else
        {
            LoadPage("public/3d_launcher.php");
        }
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // PLACES --------------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // Obtener de las variables de la URL el lugar.
    function PlaceGetFromURL()
    {
        $placeId = null;

        if (isset($_GET['placeId'])) 
        {
            $placeId = urldecode($_GET['placeId']);

            // Es importante comprobar y sanear el varlor en la URL.
            if (!in_array($placeId, [Places::AUDITORIO->value, Places::EXPOSICIONES->value, Places::SALAPRIVADA->value])) 
            {
                $placeId = null;
            }
        }

        return $placeId;
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // DATES ---------------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    function DateFormat($date)
    {
        return DateTime::createFromFormat('Y-m-d', $date);
    }

    function DateCheck($date)
    {
        // Convertir la cadena a un objeto DateTime
        $dateBase = DateFormat($date);

        // Obtener la fecha actual
        $dateCurrent = new DateTime();

        // Comparar las fechas
        // Devuelve falso si la fecha es menor que la actual.
        return $dateBase >= $dateCurrent;
    }

    function DateIntervalCheck($dateStart, $dateEnd)
    {
        // Convertir la cadena a un objeto DateTime
        $start = DateFormat($dateStart);
        $end = DateFormat($dateEnd);

        return $start <= $end;
    }

    function DateIntervalCheckCurrent($dateStart, $dateEnd)
    {
        // Convertir la cadena a un objeto DateTime
        $start = DateFormat($dateStart);
        $end = DateFormat($dateEnd);

        // Obtener la fecha actual
        $dateCurrent = new DateTime();

        $result = $start <= $dateCurrent && $end >= $dateCurrent;

        return $result;
    }
?>