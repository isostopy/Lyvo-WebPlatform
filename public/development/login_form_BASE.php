<?php

    // 1. REQUISITOS

   // Datos.
   require_once '../includes/config.php';

   // Funcionalidades comunes.
   require_once '../includes/functions.php';

   // Mensajes.
   require_once '../includes/messages.php';

   // -------------------------------------------------------------------------------------

    // 2. LOGIN   
    if(isset($_POST['submit']))
    {
        try
        {
            $email = $_POST['email'];

            // Login.
            Authenticate($email, $_POST['password']);

            // Obtener información del Usuario.
            UserGetData();

            // Redirigir al usuario según su rol.
            if (isset($_SESSION['userData']->data->role)) 
            {
                $userRole = $_SESSION['userData']->data->role;
                
                LoadPageByUserRole($userRole);
            }
            else
            {
                // Si el usuario no tiene rol, lanzamos un error.
                throw new Exception(Message_Error_UserRole());
            }
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
    }

?>


<!-- ////////// HTML HTML HTML ////////// -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyvo Login</title>
    <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
    
    <link rel="stylesheet" href="../assets/css/style_lyvo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="../assets/js/input_field_utilities.js"></script>

</head>

<body>

    <!-- CONTENEDOR PRINCIPAL -->
    <div id="content">

        <!-- HEADER -->
        <div id="header">

            <!-- LOGO -->
            <img id="logo" src="../assets/images/t_logo_lyvo_color.png" alt="Lyvo">

        </div>

        <!-- PANELS -->
        <div id="panels">

            <!-- PANEL IZQUIERDO -->
            <div id="panel-left">

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-blue">Entrar</h1>
                    </div> 

                    <div class="margin-bottom-40px"></div>

                    <!-- FORM -->
                    <form action="" method="post">

                        <!-- Subpaneles -->
                        <div class="panel-subpanels-container">

                            <div class="panel-sub flex-column flex-margin">

                                <!-- Input field email -->
                                <div class="panel-element">
                                    <h2 class="text-color-blue">E-mail</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                                        <input id="input-email" type="email" name="email" placeholder="e-mail" required>
                                    </div>
                                </div>

                                <!-- Input field contraseña -->
                                <div class="panel-element">
                                    <h2 class="text-color-blue">Contraseña</h2>
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
                                </div>

                                <div class="flex-center suboption">
                                    <input class="margin-right-10px" type="checkbox" id="remember" name="remember">
                                    <p>Recordarme</p>   
                                </div>

                            </div>

                        </div>

                        <div class="margin-bottom-40px"></div>

                        <!-- Respuestas -->
                        <?php if (isset($error)) { echo '<span class="msg msg-error">' . $error . '</span>'; echo '<div class="margin-bottom-10px"></div>';} ?>

                        <input type="submit" name="submit" value="Entrar" class="button-general button-color">

                    </form>

                    <div class="margin-bottom-10px"></div>
                    <div class="flex-center suboption">
                        <p>¿Necesitas una cuenta? <a class="link" href="register_form.php">REGISTRO</a></p>   
                    </div>

                </div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right">

                <img src="../assets/images/web-image-01.jpg" alt="Lyvo" class="img-fullsize">

            </div>
        
        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

    <script>

        fieldChecker_Load('input-email', 'icon-check-email', ['@','.'], 6);
        passDisplay_Load('input-pass','icon-show-pass','icon-hide-pass');
    
    </script>

</body>

</html>