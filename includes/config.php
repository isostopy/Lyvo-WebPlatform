<?php

    //*******************************************************************
    // PHP con datos de configuración.
    //*******************************************************************

    if (session_status() == PHP_SESSION_NONE) 
    {
        /*
        // Creación de cookie para el servidor.
        session_set_cookie_params
        ([
            'lifetime' => 60 * 60 * 24 * 30, // Duración de 30 días
        ]);
        */

        session_start();
    }

    // Base URL
    // Definimos la base para establecer rutas absolutas para evitar problemas 
    // al cargar páginas desde index.php o desde otras páginas, ya que index.php
    // al ser el elemento principal, lo va a hacer desde la raiz.



    // RESOLVER A LOCALHOST

    /*
    $URL_Base = "http://localhost/Lyvo-WebPlatform";
    $URL_Lyvo3D = $URL_Base."/3d-content/";

    // Admin token
    $DirectusToken = "-re8CEHHBLjQEV7fxIZL4v5BUIWKNBty";

    // Endpoints
    $URL_DirectusLogin = "http://localhost:8055/auth/login";
    $URL_DirectusLogout = "http://localhost:8055/auth/logout";
    $URL_DirectusUsers = "http://localhost:8055/users";
    $URL_DirectusUsersMe = "http://localhost:8055/users/me";
    $URL_DirectusRecoverPass_Request = "http://localhost:8055/auth/password/request";
    $URL_DirectusRecoverPass_Reset = "http://localhost:8055/auth/password/reset";
    $URL_RecoverPass = "http://localhost/Lyvo-WebPlatform/public/recoverPass_form_newpass.php";

    // Directus rolecode
    $Role_Aministrator = '3f543429-02b7-420e-b5d7-14f1b2d8523f';
    $Role_Client = 'c46bd43c-1030-45c2-b0b2-d8abb74b5208';
    $Role_Doctor = '297aff85-3332-4b96-8b1b-e7a49e607a0f';
    */

    // RESOLVER CON IPs

    /*
    // Base urls
    $URL_Base = "http://15.188.43.110";
    $URL_Lyvo3D = $URL_Base."/3d-content/";

    // Admin token
    $DirectusToken = "-VGG3ck0ijSH0t5yj5bgObjUxXe7WmKt";

    // Endpoints
    $URL_DirectusLogin = "http://15.188.179.241:8055/auth/login";
    $URL_DirectusLogout = "http://15.188.179.241:8055/auth/logout";
    $URL_DirectusUsers = "http://15.188.179.241:8055/users";
    $URL_DirectusUsersMe = "http://15.188.179.241:8055/users/me";
    $URL_DirectusRecoverPass_Request = "http://15.188.179.241:8055/auth/password/request";
    $URL_DirectusRecoverPass_Reset = "http://15.188.179.241:8055/auth/password/reset";
    $URL_RecoverPass = "http://15.188.43.110/public/recoverPass_form_newpass.php";

    // Directus rolecode
    $Role_Aministrator = 'b47ad7cb-c104-4a5b-a6c2-67c7e889160f';
    $Role_Client = 'ac99e1d4-c6c8-439e-ad50-9a97eed408cd';
    $Role_Doctor = 'a2327dfb-dc1f-4ef6-ac38-7be34fa86ee3';
    */

    // Resolver a URLs

    $URL_Base = "https://lyvoweb.isostopyserver.net";
    $URL_Lyvo3D = $URL_Base."/3d-content/";

    // Admin token
    $DirectusToken = "-VGG3ck0ijSH0t5yj5bgObjUxXe7WmKt";

    // Endpoints
    $URL_DirectusLogin = "http://15.188.179.241:8055/auth/login";
    $URL_DirectusLogout = "http://15.188.179.241:8055/auth/logout";
    $URL_DirectusUsers = "http://15.188.179.241:8055/users";
    $URL_DirectusUsersMe = "http://15.188.179.241:8055/users/me";
    $URL_DirectusRecoverPass_Request = "http://15.188.179.241:8055/auth/password/request";
    $URL_DirectusRecoverPass_Reset = "http://15.188.179.241:8055/auth/password/reset";
    $URL_RecoverPass = "https://lyvoweb.isostopyserver.net/public/recoverPass_form_newpass.php";

    // Directus rolecode
    $Role_Aministrator = 'b47ad7cb-c104-4a5b-a6c2-67c7e889160f';
    $Role_Client = 'ac99e1d4-c6c8-439e-ad50-9a97eed408cd';
    $Role_Doctor = 'a2327dfb-dc1f-4ef6-ac38-7be34fa86ee3';

?>