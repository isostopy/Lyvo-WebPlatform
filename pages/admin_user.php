<?php

    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Datos.
    require_once '../includes/config.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession(UserType::ADMINISTRATOR->value);

    // Obtener información del usuario.
    $userId;
    $userInformation;
    $userRole;

    // Obtener el id del usuario de la URL.
    if (isset($_GET['id'])) 
    {
        $userId = $_GET['id'];
        
        try
        {
            $userInformation = UserGetDataById($userId);
            $userRole = RoleTranslatorById($userInformation -> role);
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
    }

    // -------------------------------------------------------------------------
    //
    // La lógica de coordinación se encuentra en un archivo externo.
    //
    // -------------------------------------------------------------------------

    // Eliminar usuario.
    if(isset($_POST['submitDelete']) && isset($userId))
    {
        UserDelete($userId);
        LoadPage("pages/admin_users.php");
    }
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

                <div class="panel-content max-width-400px">

                    <!-- Título del panel -->
                    <div class="panel-title">
                        <h1 class="text-color-white">Información del usuario</h1>
                    </div> 

                    <div class="margin-bottom-40px"></div>

                    <!-- FORM -->
                    <form id="userForm" action="../utils/postAJAX.php" method="post">

                        <!-- Subpaneles -->
                        <div class="panel-subpanels-container">

                            <div class="panel-sub flex-column flex-margin-r20-c20">

                                <input type="hidden" name="userId" value="<?php echo $userId;?>">

                                <!-- Input field name -->
                                <div class="panel-element">
                                    <h2 class="text-color-white">Nombre</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-name" style="visibility:hidden;"></i>
                                        <input id="input-name" type="text" name="general-info-name" placeholder="nombre" value="<?php echo isset($userInformation->first_name) ? $userInformation->first_name : ''; ?>">
                                    </div>
                                </div>

                                <!-- Input field surname -->
                                <div class="panel-element">
                                    <h2 class="text-color-white">Apellidos</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-surname" style="visibility:hidden;"></i>
                                        <input id="input-surname" type="text" name="general-info-surname" placeholder="apellidos" value="<?php echo isset($userInformation->last_name) ? $userInformation->last_name : ''; ?>">
                                    </div>
                                </div>
                            
                                <!-- Input field email -->
                                <div class="panel-element">
                                    <h2 class="text-color-white">E-mail</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <div class="input-field-icon-container">
                                        <i class="fa fa-check input-field-icon-icon" id="icon-check-email" style="visibility:hidden;"></i>
                                        <input id="input-email" type="email" name="email" placeholder="e-mail" value="<?php echo isset($userInformation->email) ? $userInformation->email : ''; ?>">
                                    </div>
                                </div>

                                <!-- Input field tipo de usuario -->
                                <div class="panel-element">
                                    <h2 class="text-color-white">Tipo de usuario</h2>
                                    <div class="margin-bottom-5px"></div>

                                    <select id="filterDivSelect" name="general-info-role">
                                        <option value="<?php echo UserType::UNDEFINED->value;?>">No definido</option>
                                        <option value="<?php echo UserType::COMPANY->value;?>"         <?php echo ($userRole == UserType::COMPANY->value)       ? 'selected' : ''; ?>>Empresa</option>
                                        <option value="<?php echo UserType::PROFESSIONAL->value;?>"    <?php echo ($userRole == UserType::PROFESSIONAL->value)  ? 'selected' : ''; ?>>Profesional</option>
                                        <option value="<?php echo UserType::CLIENT->value;?>"          <?php echo ($userRole == UserType::CLIENT->value)        ? 'selected' : ''; ?>>Cliente</option>
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

                        <input type="submit" name="submitInfo" value="Guardar" class="button-general button-color">
                        <div class="margin-bottom-20px"></div>
                        <input type="submit" name="submitDelete" value="Eliminar usuario" class="button-general button-white">

                        <div class="margin-bottom-30px"></div>
                        <!-- Enlace volver -->
                        <div class="panel-sub flex-justify-center">
                            <a class="text-color-white" href="admin_users.php">Volver</a>
                        </div>

                    </form>

                </div>
                    
                <div class="lyvo-leaf lyvo-leaf-outline"></div>

            </div>

            <!-- PANEL DERECHO -->
            <div id="panel-right"></div>

        </div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter_Clear.php"; ?>

    </div>

    <script>

            fieldChecker_Load('input-name', 'icon-check-name', undefined, 1);
            fieldChecker_Load('input-surname', 'icon-check-surname', undefined, 1);
            fieldChecker_Load('input-email', 'icon-check-email', ['@','.'], 6);
    
            document.getElementById('userForm').addEventListener('submit', function(event) 
            {
                event.preventDefault();
        
                // Recoge los datos del formulario
                let formData = new FormData(event.target);
        
                // Realiza la petición AJAX al servidor
                fetch(event.target.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al enviar el formulario.');
                });
            });

    </script>

</body>

</html>