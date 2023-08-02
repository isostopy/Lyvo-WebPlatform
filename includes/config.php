<?php

    // PRE ------------------------------------------------------------------------
    // INICIAR SESIÓN CON COOKIE  
    if (session_status() == PHP_SESSION_NONE) 
    {
        /*
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

    $URL_Base = "http://localhost/lyvo-pre";
    $URL_Lyvo3D = "https://pruebas.isostopy.com/Lyvo";

    // Admin token
    $DirectusToken = "-re8CEHHBLjQEV7fxIZL4v5BUIWKNBty";

    // Endpoints
    $URL_DirectusLogin = "http://localhost:8055/auth/login";
    $URL_DirectusLogout = "http://localhost:8055/auth/logout";
    $URL_DirectusUsers = "http://localhost:8055/users";
    $URL_DirectusUsersMe = "http://localhost:8055/users/me";

    // Directus rolecode
    $Role_Aministrator = '3f543429-02b7-420e-b5d7-14f1b2d8523f';
    $Role_Client = 'c46bd43c-1030-45c2-b0b2-d8abb74b5208';
    $Role_Doctor = '297aff85-3332-4b96-8b1b-e7a49e607a0f';

?>