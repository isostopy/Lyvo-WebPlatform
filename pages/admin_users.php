<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession(UserType::ADMINISTRATOR->value);

    // Función para mostrar a los usuarios llamada desde HTML.
    function ShowUsersAsButtons()
    {
        // Obtener la información de todos los usuarios.
        $usersInfo = UserGetDataAll();

        // Comprobamos que la información es correcta.
        if (!isset($usersInfo->data)) 
        {
            throw new Exception(Message_Error_General());
        }

        // Creamos el mapeo de usuarios.
        $roleMapping = [
            // Código comentado para no mostrar a los administradores.
            //$GLOBALS['Role_Administrator'] => [],
            $GLOBALS['Role_Company']       => [],
            $GLOBALS['Role_Professional']  => [],
            $GLOBALS['Role_Client']        => [],
        ];

        // Categorizamos a los usuarios según su valor.
        foreach ($usersInfo->data as $user) 
        {
            if (isset($roleMapping[$user->role])) 
            {
                $roleMapping[$user->role][] = $user;
            }
        }

        // Código comentado para no mostrar a los administradores.
        //displayUsers("ADMINISTRADORES:", $roleMapping[$GLOBALS['Role_Administrator']]);
        echo '<div id="empresas">';
            displayUsers("EMPRESAS", $roleMapping[$GLOBALS['Role_Company']]);
        echo '</div>';

        echo '<div id="profesionales">';
            displayUsers("PROFESIONALES", $roleMapping[$GLOBALS['Role_Professional']]);
        echo '</div>';

        echo '<div id="clientes">';
            displayUsers("CLIENTES", $roleMapping[$GLOBALS['Role_Client']]);
        echo '</div>';
    }

    function displayUsers($title, $users) 
    {
        echo "<p class ='margin-bottom-10px'>{$title}:</p>";
        
        foreach ($users as $user) {
            echo '<button class="button-general margin-bottom-10px" onclick="location.href=\'admin_user.php?id='.$user->id.'\'">';
            echo "{$user->first_name} {$user->last_name}";
            echo '</button>';
        }
    }
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Usuarios</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

    <link rel="stylesheet" href="../assets/css/lyvo_style.css">

</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

                <h1>Administración de usuarios</h1>

                <button class ="button-general margin-bottom-50px" onclick="location.href = 'admin_user_create.php' ">CREAR USUARIO</button>

                <!-- Inputs para filtrar -->
                <div class="content-label">
                    <h2>Filtrar por tipo.</h2>
                    <select class ="margin-bottom-10px" id="filterDivSelect">
                        <option value="">Mostrar todos</option>
                        <option value="empresas">Empresas</option>
                        <option value="profesionales">Profesionales</option>
                        <option value="clientes">Clientes</option>
                    </select>
                </div>

                <div class="content-label">
                    <h2>Filtrar por usuarios.</h2>
                    <div class="input-icon">
                        <input type="text" id="filterButton" placeholder="nombre de usuario">
                    </div>
                </div>

                <!-- Botones -->
                <p class ="margin-bottom-10px">A continuación se muestran los usuarios.</p>

                <?php 
                    
                    ShowUsersAsButtons();

                    if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } 
                    
                ?>
               
            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <div id="textos-inferiores">

            <div id="copyright">
                <p>Copyright 2023© All rights reserved</p>
            </div>

            <div id="botones-esquina">
                <div id="politica-privacidad">
                    <a href="../public/privacy.html">Política de privacidad</a>
                </div>

                <div id="cookies">
                    <a href="../public/privacy.html">Aviso de cookies</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Cargamos el script de filtrado -->
    <script src="../assets/js/filter.js"></script>

</body>

</html>