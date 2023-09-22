<?php

    // 1. REQUISITOS

    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // -------------------------------------------------------------------------------------

    // 2. COMPROBAR SESIÓN

    // Comprobar si el usuario tiene sesión iniciada. 
    // No hay sesión, enviar a Welcome.
    if (!isset($_SESSION['userData']))
    {
        LoadPage("public/welcome.php");
    }

    // Hay sesión, enviar a la página según su rol.
    else
    {
        // Comprobar que tenemos rol.
        if(isset($_SESSION['userData']->data->role))
        {
            $userRole = $_SESSION['userData']->data->role;
            LoadPageByUserRole($userRole);
        }

        // Si no hay rol, enviar a Welcome.
        else
        {
            LoadPage("public/welcome.php");
        }
    }
?>