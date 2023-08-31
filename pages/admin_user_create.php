<?php

    // Funcionalidades comunes.
    require_once '../includes/functions.php';

    // Datos.
    require_once '../includes/config.php';

    // Messages.
    require_once '../includes/messages.php';

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
                $_POST['general-info-name'], 
                $_POST['general-info-surname'],
                $_POST['general-info-email'],
                $_POST['password'],
                $_POST['general-info-role'],

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
   <title>Lyvo Historia</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
   <link rel="stylesheet" href="../assets/css/lyvo_style.css">
   <link rel="stylesheet" href="../assets/css/medicalInformation_form.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script src="../assets/js/input_field_utilities.js"></script>

</head>

<body>
   <div class="main-container">

      <div id="lyvo-logo">
         <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
      </div>

      <div id="left-panel">

         <div id="hoja-livo"></div>

         <div class="content">

            <h1>Crear usuario</h1>

            <form id="userForm" action="" method="post">

                <div class="content-label">

                    <h2>Nombre</h2>

                    <div class="input-icon">

                        <i id="name-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                        <input id="name-input" type="text" name="general-info-name" placeholder="Nombre" value="<?php echo isset($userInformation->first_name) ? $userInformation->first_name : ''; ?>" required>

                    </div>

                </div>

                <div class="content-label">

                    <h2>Apellidos</h2>

                    <div class="input-icon">

                    <i id="surname-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                    <input id="surname-input" type="text" name="general-info-surname" placeholder="Apellidos" value="<?php echo isset($userInformation->last_name) ? $userInformation->last_name : ''; ?>" required>

                    </div>

                </div>

                <div class="content-label">

                    <h2>Email</h2>

                    <div class="input-icon">

                    <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                    <input id="email-input" type="text" name="general-info-email" placeholder="E-mail" value="<?php echo isset($userInformation->email) ? $userInformation->email : ''; ?>" required>

                    </div>

                </div>

                <div class="content-label">

                    <h2>Contraseña</h2>

                    <div class="input-icon">
                        <i class="fa fa-check icon-input icon-input-margin-right" id="pass-check-icon" style="visibility:hidden;"></i>

                        <div id="show-pass-icon" class="hover-pointer" style="visibility:visible;">
                            <i class="fa fa-eye-slash icon-input"></i>
                        </div>

                        <div id="hide-pass-icon" class="hover-pointer" style="visibility:hidden;">
                            <i class="fa fa-eye icon-input"></i>
                        </div>

                        <input id="pass-input" type="password" name="password" placeholder="Contraseña" required>

                    </div>

                    <p class="caracteres-minimos">La contraseña debe tener al menos 6 caracteres</p>

                </div>

                <div class="content-label">

                    <h2>Tipo de usuario</h2>

                    <select class="margin-bottom-10px" id="filterDivSelect" name="general-info-role">
                        <option value="<?php echo UserType::CLIENT->value;?>">Cliente</option>
                        <option value="<?php echo UserType::COMPANY->value;?>">Empresa</option>
                        <option value="<?php echo UserType::PROFESSIONAL->value;?>">Profesional</option>
                    </select>

                </div>

                <?php
                    if (!empty($message)) { echo '<span class="msg msg-confirm">'.$message.'</span>'; }
                    if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }
                ?>
                
                <input type="submit" name="submit" value="CREAR">

            </form>

         </div>

      </div>

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

      <div id="right-panel">

      </div>

      <div id="hoja-livo-grande">

      </div>

   </div>

   <script>

        passDisplay_Load('pass-input','show-pass-icon','hide-pass-icon');
        
        fieldChecker_Load('name-input', 'name-check-icon', null, 1);
        fieldChecker_Load('surname-input', 'surname-check-icon', null, 1);

        fieldChecker_Load('email-input', 'email-check-icon', ['@','.'], 6);    
        fieldChecker_Load('pass-input', 'pass-check-icon', null, 6);
   

   </script>

</body>

</html>