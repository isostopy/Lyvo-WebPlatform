<?php

    // Datos.
    require '../includes/config.php';
    // Funcionalidades comunes.
    require 'email.php';

    // FUNCIONES -----------------------------------------------------------------------------


    // SISTEMA GENERAL PARA REALIZAR PETICIONES
    function HttpRequest($mode, $url, $headers, $data)
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
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // Realizar la petición.
        $response = curl_exec($curl);

        // Obtener el código de estado HTTP.
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Gestión de errores.
        if (curl_errno($curl)) 
        {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception("Error en la petición: ".$error);
        }
        // Verificar el código de estado HTTP.
        else if ($httpcode >= 400) 
        {
            curl_close($curl);
            throw new Exception("La petición devolvió un error HTTP: ".$httpcode);
        }

        curl_close($curl);

        return $response;
    }



    // REGISTRO
    function Register($user_Name, $user_LastName, $user_Email, $user_Password)
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);
        $body = array(
            'email' =>  $user_Email, 
            'password' => $user_Password,
            'first_name' => $user_Name,
            'last_name' => $user_LastName,
            'role' => $GLOBALS['Role_Client'],
            'status' => 'invited'
        );

        $jsonBody = json_encode($body);

        // Enviar la solicitud.
        $responseRegister = HttpRequest('POST', $GLOBALS['URL_DirectusUsers'], $headers, $jsonBody);

        $obj = json_decode($responseRegister);

        // Gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception("Se ha producido un error al registrar el usuario");
        }

        // Enviar email de confirmación.
        ConfirmEmailSend($obj->data);
    }



    // CONFIRMAR EMAIL
    function ConfirmEmailSend($userInfo)
    {
        $userId = $userInfo->id;

        $userEmail = $userInfo->email;
        $subject = "No-Reply: Lyvo bienvenida.";
        $body = "Gracias por registrarte en nuestra plataforma. Pulsa el siguiente enlace para validar tu E-mail: ".$GLOBALS['URL_Base']."/pages/register_emailValidation.php?user=".$userId;
        $bodyNonHTML = "Gracias por registrarte en nuestra plataforma. Pulsa el siguiente enlace para validar tu E-mail: ".$GLOBALS['URL_Base']."/pages/register_emailValidation.php?user=".$userId;

        SendEmail($userEmail, $subject, $body, $bodyNonHTML);
    }



    // CONFIRMAR EMAIL
    function UserValidate($userId)
    {
        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$GLOBALS['DirectusToken']);
        $body = array( 'status' =>  'active' );

        $jsonBody = json_encode($body);

        $urlUser = $GLOBALS['URL_DirectusUsers']."/".$userId;

        // Enviar la solicitud.
        $responseValidation = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);

        $obj = json_decode($responseValidation);

        // Gestionar la respuesta.
        if (!isset($obj->data)) 
        {
            throw new Exception("Se ha producido un error al registrar el usuario");
        }

        // Comprobar que el estado del usuario se ha ajustado correctamente.
        if($obj->data->status !== "active")
        {
            throw new Exception("Se ha producido un error al registrar el usuario");
        }
    }



    // AUTENTICACIÓN
    function Authenticate($user_Email, $user_Password)
    {
      $headers = array('Content-Type: application/json');
      $credentials = array('email' =>  $user_Email, 'password' => $user_Password);
      $jsonCredentials = json_encode($credentials);

      // Enviar la solicitud.
      $responseLogin = HttpRequest('POST', $GLOBALS['URL_DirectusLogin'], $headers, $jsonCredentials);

      // Gestionar la respuesta.
      $obj = json_decode($responseLogin);

      if (!isset($obj->data->access_token, $obj->data->refresh_token)) 
      {
        throw new Exception("Credenciales incorrectas");
      }
      else
      {
        $_SESSION['userAccessToken'] = $obj->data;
        return $obj->data->access_token;
      }
    }



    // LOGOUT
    function Logout()
    {
        // Cerrar sesión en Directus. Invalidar refresh token.

        $headers = array('Content-Type: application/json');
        $credentials = array('refresh_token' => $_SESSION['userAccessToken']->refresh_token);
        $jsonCredentials = json_encode($credentials);

        // Enviar la solicitud.
        $responseLogin = HttpRequest('POST', $GLOBALS['URL_DirectusLogout'], $headers, $jsonCredentials);


        // Cerrar sesión en el servidor.

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

        // Redirigir al usuario a la página de inicio de sesión.
        LoadPage("public/login_form.php");
    }



    // RECOVER PASS REQUEST
    function UserRecoverPassRequest($email)
    {      
        $headers = array('Content-Type: application/json');
        $credentials = array('email' =>  $email, 'reset_url' => $GLOBALS['URL_RecoverPass']);
        $jsonCredentials = json_encode($credentials);
  
        // Enviar la solicitud.
        $responseLogin = HttpRequest('POST', $GLOBALS['URL_DirectusRecoverPass_Request'], $headers, $jsonCredentials);

        // No hay respuesta, Directus envía el correo y devuelve 204 No Content.
    }



    // RECOVER PASS RESET
    function UserRecoverPassSet($token, $pass)
    {
        $headers = array('Content-Type: application/json');
        $credentials = array('token' =>  $token, 'password' => $pass);
        $jsonCredentials = json_encode($credentials);
  
        // Enviar la solicitud.
        $responseLogin = HttpRequest('POST', $GLOBALS['URL_DirectusRecoverPass_Reset'], $headers, $jsonCredentials);

        // No hay respuesta, Directus envía el correo y devuelve 204 No Content.
    }



    // OBTENER INFORMACIÓN DEL USUARIO
    function UserGetData($access_token)
    {
      $headers = array('Content-Type: application/json','Authorization: Bearer '.$access_token);

      $responseData = HttpRequest('GET', $GLOBALS['URL_DirectusUsersMe'], $headers, null);

      $obj = json_decode($responseData);

      $_SESSION['userData'] = $obj;
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
            case $GLOBALS['Role_Client']: LoadPage("pages/client_page.php"); break;
            // Médico
            case $GLOBALS['Role_Doctor']: LoadPage("pages/doctor_page.php"); break;
            // Administrador
            case $GLOBALS['Role_Aministrator']: LoadPage("pages/admin_page.php"); break;           
        }
    }



    // COMPROBAR LA SESIÓN Y EL USUARIO
    function UserCheckSession($role)
    {
        // Si no hay una sesión iniciada, cargar Login.
        if(!isset($_SESSION['userData']->data->role))
        {
            LoadPage("public/login_form.php");
        }
        // Si hay abierta una sesión, comprobar que el rol no coincide.
        else
        {
            if($_SESSION['userData']->data->role !== $role)
            {
                LoadPage("public/login_form.php");
            }
        } 
    }



    // GUARDAR AVATAR
    function UserAvatarSave($avatar)
    {
        // Comprobar la sesión.
        if (!isset($_SESSION['userAccessToken']))
        {
            LoadPage("public/login_form.php");
        }

        $bearer = $_SESSION['userAccessToken']->access_token;

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);
        $body = array('AvatarInformation' => array('type' => $avatar));

        $jsonBody = json_encode($body);

        $urlUser = $GLOBALS['URL_DirectusUsersMe'];

        // Enviar la solicitud.
        $responseAvatar = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);

        $obj = json_decode($responseAvatar);

        // Gestionar la respuesta.
        if (!isset($obj->data) || !$obj->data->AvatarInformation) 
        {
            throw new Exception("Se ha producido un error al registrar el usuario");
        }

        // Guardar la nueva información en la sesión.
        $_SESSION['userData'] = $obj;
    }



    // GUARDAR INFORMACIÓN MÉDICA
    // La variable de información tiene que venir codificada en JSON.
    function MedicalInformationSave($jsonBody)
    {
        // Comprobar la sesión.
        if (!isset($_SESSION['userAccessToken']))
        {
            LoadPage("public/login_form.php");
        }

        $bearer = $_SESSION['userAccessToken']->access_token;

        // Preparar los datos.
        $headers = array('Content-Type: application/json','Authorization: Bearer '.$bearer);

        $urlUser = $GLOBALS['URL_DirectusUsersMe'];

        // Enviar la solicitud.
        $responseMedInfo = HttpRequest('PATCH', $urlUser, $headers, $jsonBody);

        $obj = json_decode($responseMedInfo);

        // Comprobar y gestionar la respuesta.
        if (!isset($obj->data) || !$obj->data->MedicalInformation) 
        {
            throw new Exception("Se ha producido un error al actualizar la información");
        }

        // Guardar la nueva información en la sesión.
        $_SESSION['userData'] = $obj;
    }
?>