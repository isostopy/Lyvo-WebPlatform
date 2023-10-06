<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession(UserType::ADMINISTRATOR->value);

    $roleSortOut = UsersSortOut();

    function UsersSortOut()
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

        return $roleMapping;
    }

    function UsersDisplay($users)
    {
        echo '<ul class="list-general">';  // Inicia la lista no ordenada
        
        foreach ($users as $user) {
            echo '<li>';
            echo '<a class="link link-text text-color-blue" href="admin_user.php?id='.$user->id.'">'.$user->first_name.' '.$user->last_name.'</a>';
            echo '</li>';
            echo '<div class="margin-bottom-10px"></div>';
        }
        
        echo '</ul>';  // Finaliza la lista no ordenada
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

    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

</head>

<!-- Fondo oscuro -->
<body style="background-color: var(--color_2);">

    <!-- CONTENEDOR PRINCIPAL -->
    <div id="content">

        <!-- HEADER -->
        <div id="header">

            <!-- LOGO -->
            <img id="logo" src="../assets/images/t_logo_lyvo_white.png" alt="Lyvo">
            
        </div>

        <!-- PANELS -->
        <div id="panels">

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left" class="width-60vw flex-align-center">

                <div class="margin-bottom-10vh"></div> <!-- Margen header -->
                <div class="margin-bottom-10px"></div>

                <div class="panel-content width-100">

                    <!-- Título del panel -->
                    <div class="panel-title max-width-300px">
                        <h1 class="text-color-white">Administración de usuarios</h1>
                    </div>

                    <div class="margin-bottom-40px"></div>

                    <!-- Subpaneles -->
                    <div class="panel-subpanels-container">

                        <!-- PANEL DE CONTROLES -->
                        <div class="panel-sub flex-column max-width-300px">

                            <!-- Inputs para filtrar -->
                            <div class="panel-element">
                                <h2 class="text-color-white">Filtrar por tipo</h2>
                                <div class="margin-bottom-5px"></div>
                                <select id="filterDivSelect">
                                    <option value="">Mostrar todos</option>
                                    <option value="empresas">Empresas</option>
                                    <option value="profesionales">Profesionales</option>
                                    <option value="clientes">Clientes</option>
                                </select>
                            </div>

                            <div class="margin-bottom-20px"></div>

                            <!-- Input field filter -->
                            <div class="panel-element">
                                <h2 class="text-color-white">Filtrar por usuario</h2>
                                <div class="margin-bottom-5px"></div>
                                <div class="input-icon">
                                    <input type="text" id="inputFilterUser" placeholder="Nombre de usuario">
                                </div>
                            </div>

                            <div class="margin-bottom-30px"></div>

                            <!-- Botón crear usuario -->
                            <button class ="button-general button-color" onclick="location.href = 'admin_user_create.php' ">Crear usuario</button>
                            
                            <div class="margin-bottom-30px"></div>

                            <!-- Enlace volver -->
                            <div class="panel-sub flex-justify-center">
                                <a class="text-color-white" href="role_page_admin.php">Volver</a>
                            </div>

                            <div class="margin-bottom-20px"></div>

                        </div>

                        <!-- PANEL DE ETIQUETAS DE USUARIO -->
                        <div class="panel-sub flex-column">

                            <h2 class="text-color-none">///</h2>
                            <div class="margin-bottom-5px"></div>

                            <div class="panel-subpanels-container flex-column overflow-scroll">
                                
                                <!-- Panel Empresas -->
                                <div id="empresas" class="panel-sub flex-column panel-background-white">

                                    <!-- Título -->
                                    <h2 class="text-color-blue">EMPRESAS</h2>

                                    <!-- Barra -->
                                    <div class="bar-horizontal"></div>
                                    <div class="margin-bottom-20px"></div>

                                    <!-- Listado -->
                                    <?php

                                        UsersDisplay($roleSortOut[$GLOBALS['Role_Company']]);

                                    ?>

                                </div>

                                <div class="margin-bottom-20px"></div>

                                <!-- Panel Profesionales -->
                                <div id="profesionales" class="panel-sub flex-column panel-background-white">

                                    <!-- Título -->
                                    <h2 class="text-color-blue">PROFESIONALES</h2>

                                    <!-- Barra -->
                                    <div class="bar-horizontal"></div>
                                    <div class="margin-bottom-20px"></div>

                                    <!-- Listado -->
                                    <?php

                                        UsersDisplay($roleSortOut[$GLOBALS['Role_Professional']]);

                                    ?>

                                </div>

                                <div class="margin-bottom-20px"></div>

                                <!-- Panel Clientes -->
                                <div id="clientes" class="panel-sub flex-column panel-background-white">

                                    <!-- Título -->
                                    <h2 class="text-color-blue">CLIENTES</h2>

                                    <!-- Barra -->
                                    <div class="bar-horizontal"></div>
                                    <div class="margin-bottom-20px"></div>

                                    <!-- Listado -->
                                    <?php

                                        UsersDisplay($roleSortOut[$GLOBALS['Role_Client']]);

                                    ?>

                                </div>


                            </div>

                            <?php 
                            
                            if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; } 
                            
                            ?>

                        </div>

                        <div class="margin-bottom-40px"></div>
                        
                    </div>

                </div>

                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right">

                <img src="../assets/images/web-image-02.jpg" alt="Lyvo" class="img-fullsize">

            </div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

    <!-- Cargamos el script de filtrado -->
    <script src="../assets/js/filter.js"></script>

</body>

</html>