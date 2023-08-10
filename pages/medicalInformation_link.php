<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';
   // Datos.
   require '../includes/config.php';

   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);
   
   // Mostrar información
   $userData = $_SESSION['userData']->data;
   $userId = $userData->id;

   echo $userId;
?>