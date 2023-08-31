<?php

    // Funcionalidades comunes.
    require_once '../includes/functions.php';
    require_once '../includes/messages.php';

    // Almacenar información del usuario.
    // En este caso estamos detectando que se está haciendo post con uno de los valores que
    // enviamos, porque de otro modo por como recopilamos la información con "FormData" en JS,
    // el campo del botón no se añade.

    if(isset($_POST['general-info-name']))
    {
        $userId = $_POST['userId'];

        // Comprobar que el rol usuario está definido.
        if($_POST['general-info-role'] == UserType::UNDEFINED->value)
        {
            echo(Message_Error_UserRoleNotDefined());
            return;
        }

        // Procesar información.
        $userUpdatedInfo = array(

            "first_name" => $_POST['general-info-name'],
            "last_name" => $_POST['general-info-surname'],
            "email" => $_POST['general-info-email'],
            "role" => RoleTranslatorByName($_POST['general-info-role'])
        );

        $jsonBody = json_encode($userUpdatedInfo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Enviar información
        UserSaveData($userId, $jsonBody);

        echo(Message_Ok_InfoSaved());
    }
    else
    {
        echo(Message_Error_InfoSaved());
    }

?>