<?php

    // Datos.
    require '../includes/config.php';
    // Datos.
    require '../includes/functions.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession($GLOBALS['Role_Client']);

    Logout();
?>