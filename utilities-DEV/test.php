<?php

    // Mensajes.
    require_once '../includes/messages.php';
    require_once '../includes/functions.php';

    echo 'access_token:';
    echo GetStoredToken('access_token');
    echo '<br>';
    echo 'refresh_token:';
    echo GetStoredToken('refresh_token');
    echo '<br>';
    echo 'user:'.$_SESSION['userData']->data->role;;

?>