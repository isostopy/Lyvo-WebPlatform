<?php
    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    LoadPage("public/welcome.php");

    /*
    // Inicio de la sesión. Todo el mundo que necesite de sesiones tiene que cargar este script.
    if (!isset($_SESSION['userData']))
    {
        LoadPage("public/welcome.php");
    }
    else
    {
        $userRole = $_SESSION['userData']->data->role;

        LoadPageByUserRole($userRole);
    }
    */
?>