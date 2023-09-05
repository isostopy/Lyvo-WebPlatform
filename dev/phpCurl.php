<?php

    if (function_exists('curl_init')) 
    {
        echo 'cURL está habilitado en este servidor.';
    } 
    else 
    {
        echo 'cURL NO está habilitado en este servidor.';
    }

?>