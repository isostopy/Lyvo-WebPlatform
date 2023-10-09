<?php

    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Datos.
    require_once '../includes/config.php';
    // Messages.
    require_once '../includes/messages.php';

    // Comprobamos el usuario
    UserCheckSession(UserType::ADMINISTRATOR->value);

    $client = UserType::CLIENT;

    if(isset($_POST['submit']))
    {
        try
        {
            $pass = $_POST['password'];

            // Comprobar contraseña
            if (isset($_POST['password'])) 
            {
                if(strlen($pass)<6)
                {
                    throw new Exception(Message_Error_PassRequirements());
                }           
            }
        
            // Login.
            // Se pueden comprobar todos estos cámpos, pero ya lo está haciendo el HTML con "required".
            Register(

                //Parámetros que recoge el formulario.
                $_POST['name'], 
                $_POST['surname'],
                $_POST['email'],
                $_POST['password'],
                $_POST['role'],

                // Parámetros que asignamos por crear la cuenta desde un administrador.
                UserStatus::ACTIVE->value, // Usuario activado por defecto.
                false               // Envio de email de confirmación.
            );

            LoadPage("pages/admin_user_create_congrats.php");
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
    };
?>


<!DOCTYPE html>
<html>

<head>
   
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lyvo Registro</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>

   <link rel="stylesheet" href="../assets/css/style_lyvo.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/input_field_utilities.js"></script>

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
            <div id="panel-left" class="width-60vw flex-align-center flex-justify-center">

                <div class="panel-content max-width-700px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Crear usuario</h1>
                    </div>   

                    <div class="margin-bottom-40px"></div>

                    <!-- FORM -->
                    <form id="userForm" action="" method="post">

                        <div class="panel-subpanels-container">

                            <div class="panel-sub flex-wrap flex-margin-r20-c20 flex-spaceBetween">

                                <!-- Input field name -->
                                <div class="panel-element-adaptative">
                                    <h2 class="text-color-white">Nombre</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-name" style="visibility:hidden;"></i>
                                        <input id="input-name" type="text" name="name" placeholder="nombre" required>
                                    </div>
                                    
                                </div>

                                <!-- Input field apellido -->
                                <div class="panel-element-adaptative">
                                    <h2 class="text-color-white">Apellidos</h2>
                                    <div class="margin-bottom-5px"></div>
                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-surname" style="visibility:hidden;"></i>
                                        <input id="input-surname" type="text" name="surname" placeholder="apellidos" required>
                                    </div>

                                </div>

                                <!-- Input field email -->
                                <div class="panel-element-adaptative">
                                    <h2 class="text-color-white">E-mail</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                                        <input id="input-email" type="email" name="email" placeholder="e-mail" required>
                                    </div>

                                </div>

                                <!-- Input field contraseña -->
                                <div class="panel-element-adaptative">
                                    <h2 class="text-color-white">Contraseña</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon margin-right-20px" id="icon-check-pass" style="visibility:hidden;"></i>
                                        
                                        <div id="icon-show-pass" class="hover-pointer" style="visibility:visible;">
                                            <i class="fa fa-eye-slash input-field-icon-icon"></i>
                                        </div>

                                        <div id="icon-hide-pass" class="hover-pointer" style="visibility:hidden;">
                                            <i class="fa fa-eye input-field-icon-icon"></i>
                                        </div>
                                        
                                        <input id="input-pass" type="password" name="password" placeholder="contraseña" required>
                                    </div>
                                    
                                    <div class="margin-bottom-5px"></div>
                                    <p class="element-info-detail text-color-white">La contraseña debe tener al menos 6 caracteres</p>

                                </div>

                                <!-- Inputs para filtrar -->
                                <div class="panel-element-adaptative">
                                    <h2 class="text-color-white">Tipo de usuario</h2>
                                    <div class="margin-bottom-5px"></div>
                                    
                                    <select id="filterDivSelect" name="role">
                                        <option value="<?php echo UserType::CLIENT->value;?>">Cliente</option>
                                        <option value="<?php echo UserType::COMPANY->value;?>">Empresa</option>
                                        <option value="<?php echo UserType::PROFESSIONAL->value;?>">Profesional</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="margin-bottom-20px"></div>

                        <?php
                            if (!empty($message)) { echo '<span class="msg msg-confirm">'.$message.'</span>'; }
                            if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }
                        ?>
                        
                        <div class="margin-bottom-20px"></div>

                        <input id="button-create" type="submit" name="submit" value="Crear usuario" class="button-general button-color">

                    </form>

                    <div class="margin-bottom-30px"></div>

                    <!-- Enlace volver -->
                    <div class="panel-sub flex-justify-center">
                        <a class="text-color-white" href="admin_users.php">Volver</a>
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

    <script>

        passDisplay_Load('input-pass','icon-show-pass','icon-hide-pass');
        
        fieldChecker_Load('input-name', 'icon-check-name', null, 1);
        fieldChecker_Load('input-surname', 'icon-check-surname', null, 1);

        fieldChecker_Load('input-email', 'icon-check-email', ['@','.'], 6);    
        fieldChecker_Load('input-pass', 'icon-check-pass', null, 6);

   </script>

</body>

</html>