<?php

    // Funcionalidades comunes.
    require '../includes/functions.php';

    // Inicio de la sesión. Todo el mundo que necesite de sesiones tiene que cargar este script.
    if (!isset($_SESSION['userData']))
    {
        LoadPage("public/login_form.php");
        exit;
    }
    else
    {
        $userRole = $_SESSION['userData']->data->role;

        LoadPageByUserRole($userRole);
    }
?>