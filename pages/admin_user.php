<?php

    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    // Datos.
    require_once '../includes/config.php';

    // Comprobar que el usuario tiene sesión iniciada.
    UserCheckSession();

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
            $userInformation = UserGetData_FilterAllUsers($userId);
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

            <h1>Información del usuario</h1>

            <form id="userForm" action="../utils/postAJAX.php" method="post">

                <input type="hidden" name="userId" value="<?php echo $userId;?>">

                <div class="content-label">

                    <h2>Nombre</h2>

                    <div class="input-icon">

                        <i id="name-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                        <input id="name-input" type="text" name="general-info-name" placeholder="Nombre" value="<?php echo isset($userInformation->first_name) ? $userInformation->first_name : ''; ?>">

                    </div>

                </div>

                <div class="content-label">

                    <h2>Apellidos</h2>

                    <div class="input-icon">

                    <i id="surname-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                    <input id="surname-input" type="text" name="general-info-surname" placeholder="Apellidos" value="<?php echo isset($userInformation->last_name) ? $userInformation->last_name : ''; ?>">

                    </div>

                </div>

                <div class="content-label">

                    <h2>Email</h2>

                    <div class="input-icon">

                    <i id="email-check-icon" class="fa fa-check icon-input" style="visibility:hidden;"></i>
                    <input id="email-input" type="text" name="general-info-email" placeholder="E-mail" value="<?php echo isset($userInformation->email) ? $userInformation->email : ''; ?>">

                    </div>

                </div>

                <div class="content-label">

                    <h2>Tipo de usuario</h2>

                    <select class="margin-bottom-10px" id="filterDivSelect" name="general-info-role">
                        <option value="<?php echo UserType::UNDEFINED->value;?>">No definido</option>
                        <option value="<?php echo UserType::COMPANY->value;?>"         <?php echo ($userRole == UserType::COMPANY->value)       ? 'selected' : ''; ?>>Empresa</option>
                        <option value="<?php echo UserType::PROFESSIONAL->value;?>"    <?php echo ($userRole == UserType::PROFESSIONAL->value)  ? 'selected' : ''; ?>>Profesional</option>
                        <option value="<?php echo UserType::CLIENT->value;?>"          <?php echo ($userRole == UserType::CLIENT->value)        ? 'selected' : ''; ?>>Cliente</option>
                    </select>

                </div>

                <?php

                    if (!empty($message)) { echo '<span class="msg msg-confirm">'.$message.'</span>'; }
                    if (isset($error)) { echo '<span class="msg msg-error">'.$error.'</span>'; }

                ?>
                
                <input type="submit" name="submitInfo" value="GUARDAR">
                <input type="submit" name="submitDelete" value="ELIMINAR USUARIO">

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

        fieldChecker_Load('name-input', 'name-check-icon', undefined, 1);
        fieldChecker_Load('surname-input', 'surname-check-icon', undefined, 1);
        fieldChecker_Load('email-input', 'email-check-icon', ['@','.'], 6);
   
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