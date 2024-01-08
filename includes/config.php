<?php

    //*******************************************************************
    // PHP con datos de configuración.
    //*******************************************************************

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // SESIÓN Y COOKIES ----------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

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

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // TIPO DE USUARIO -----------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // User type
    enum UserType: string{

        case UNDEFINED = 'No definido';
        case ADMINISTRATOR = 'Administrador';
        case COMPANY = 'Empresa';
        case PROFESSIONAL = 'Profesional';
        case CLIENT = 'Cliente';
        
    }

    // User status
    enum UserStatus: string{

        case INVITED = 'invited';
        case ACTIVE = 'active';

    }

    // Rooms
    enum Rooms: string {

        case AUDITORIO = 'auditorio';
        case EXPOSICIONES = 'exposiciones';
        case SALAPRIVADA = "salaprivada";

    }

    // ---------------------------------------------------------------------------------------------------------------------------------------
    // URLs ----------------------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------------------------

    // Base URL
    // Definimos la base para establecer rutas absolutas para evitar problemas 
    // al cargar páginas desde index.php o desde otras páginas, ya que index.php
    // al ser el elemento principal, lo va a hacer desde la raiz.



    // RESOLVER A LOCALHOST
	/*

    // QUIZÁ TODO ESTE CÓDIGO SEA MEJOR METERLO EN ENUMERACIONES QUE SON INMUTABLES Y NO SE PUEDEN CAMBIAR EN TIEMPO DE EJECUCIÓN ------------
    $URL_Base = "http://localhost/Lyvo-WebPlatform";
    $URL_Lyvo3D = $URL_Base."/3d-content/";

    // Partial
    $URL_Partial_Validation = "/pages/register_emailValidation.php?user=";

    // Admin token
    $DirectusToken = "gpD_NSRqmyjGFddyhMKN-hwxFCDvsbJG";


    // Endpoints
    //CMS
    $URL_DirectusLogin = "http://localhost:8055/auth/login";
    $URL_DirectusRefresh = "http://localhost:8055/auth/refresh";
    $URL_DirectusLogout = "http://localhost:8055/auth/logout";
    $URL_DirectusUsers = "http://localhost:8055/users";
    $URL_DirectusUsersMe = "http://localhost:8055/users/me";
    $URL_DirectusRecoverPass_Request = "http://localhost:8055/auth/password/request";
    $URL_DirectusRecoverPass_Reset = "http://localhost:8055/auth/password/reset";

    $URL_RecoverPass = "http://localhost/Lyvo-WebPlatform/public/recoverPass_form_newpass.php";
    $URL_LoginEditor = "http://localhost/Lyvo-WebPlatform/public/login_form_editor.php";

    $URL_DirectusItems = "http://localhost:8055/items/";

    // Directus rolecode
    $Role_Administrator = '3f543429-02b7-420e-b5d7-14f1b2d8523f';
    $Role_Company = '61b7f792-de6e-4913-bc06-72d2a26bd2e3';
    $Role_Professional = '297aff85-3332-4b96-8b1b-e7a49e607a0f';
    $Role_Client = 'c46bd43c-1030-45c2-b0b2-d8abb74b5208';

*/

    // RESOLVER A URLs
    $URL_Base = "https://lyvoweb.isostopyserver.net";
    $URL_Lyvo3D = $URL_Base."/3d-content/";

    // Partial
    $URL_Partial_Validation = "/pages/register_emailValidation.php?user=";

    // Admin token
    $DirectusToken = "XB0cW-gitsmiWnX4nqf8i6dlARG-1ijX";

    // Endpoints
    //CMS
    $URL_DirectusLogin = "https://lyvocms.isostopyserver.net/auth/login";
    $URL_DirectusRefresh = "https://lyvocms.isostopyserver.net/auth/refresh";
    $URL_DirectusLogout = "https://lyvocms.isostopyserver.net/auth/logout";
    $URL_DirectusUsers = "https://lyvocms.isostopyserver.net/users";
    $URL_DirectusUsersMe = "https://lyvocms.isostopyserver.net/users/me";
    $URL_DirectusRecoverPass_Request = "https://lyvocms.isostopyserver.net/auth/password/request";
    $URL_DirectusRecoverPass_Reset = "https://lyvocms.isostopyserver.net/auth/password/reset";

    $URL_RecoverPass = "https://lyvoweb.isostopyserver.net/public/recoverPass_form_newpass.php";
    $URL_LoginEditor = "https://lyvoweb.isostopyserver.net/public/login_form_editor.php";

    $URL_DirectusItems = "https://lyvocms.isostopyserver.net/items/";

    // Directus rolecode
    $Role_Administrator = 'b47ad7cb-c104-4a5b-a6c2-67c7e889160f';
    $Role_Company = 'caca6253-adef-4e3d-828a-7153d23cd193';
    $Role_Professional = 'a2327dfb-dc1f-4ef6-ac38-7be34fa86ee3';
    $Role_Client = 'ac99e1d4-c6c8-439e-ad50-9a97eed408cd';
?>