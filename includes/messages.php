<?php

    //*******************************************************************
    // PHP con mensajes de información.
    //*******************************************************************

    // ERROR --------------------------------------------------------------------------------------------------

    function Message_Error_General()
    {
        return "Se ha producido un error.";
    }

    function Message_Error_Unauthorized()
    {
        return "El usuario o la contraseña no son válidos.";
    }

    function Message_Error_Register()
    {
        return "Se ha producido un error al registrar el usuario.";
    }

    function Message_Error_Delete()
    {
        return "Se ha producido un error al eliminar el usuario.";
    }

    function Message_Error_Login()
    {
        return "No se ha podido realizar el login.";
    }

    function Message_Error_PassRequirements()
    {
        return "La contreaseña debe tener al menos 6 caracteres";
    }

    function Message_Error_TermsCondNo()
    {
        return "Debe aceptar los términos y condiciones.";
    }

    function Message_Error_InfoGet()
    {
        return "Se ha producido un error al obtener la información.";
    }

    function Message_Error_InfoSave()
    {
        return "Se ha producido un error al guardar la información.";
    }

    function Message_Error_InfoMedNo()
    {
        return "El usuario no tiene información médica registrada.";
    }

    function Message_Error_EmailSend()
    {
        return "Se ha producido un error al enviar el e-mail de confirmación. Por favor, contacte con el soporte.";
    }

    function Message_Error_UserNotRegistered()
    {
        return "El usuario no se encuentra registrado en el sistema.";
    }

    function Message_Error_UserRole()
    {
        return "Se ha producido un error con su rol de usuario. Por favor, contacte con el soporte.";
    }

    function Message_Error_UserRoleNotDefined()
    {
        return "Es necesario seleccionar un tipo de usuario.";
    }

    function Message_Error_PlaceSelected()
    {
        return "El lugar seleccionado no se encuentra registrado.";
    }

    function Message_Error_InfoSaved()
    {
        return "Se ha producido un error al guardar la información.";
    }

    function Message_Error_Dates()
    {
        return "La fecha de inicio debe ser anterior a la fecha de fin.";
    }

    function Message_Error_BookingWrite()
    {
        return "No se ha podido almacenar la información de la reserva.";
    }

    // OK --------------------------------------------------------------------------------------------------

    function Message_Ok_Validation()
    {
        return "Validación completa.";
    }

    function Message_Ok_InfoSaved()
    {
        return "Información guardada correctamente.";
    }

    // EMAIL --------------------------------------------------------------------------------------------------

    function Email_Register_Subject()
    {
        return "No-Reply: Lyvo bienvenida.";
    }

    function Email_Register_Body()
    {
        return "Gracias por registrarte en nuestra plataforma. Pulsa el siguiente enlace para validar tu E-mail: ";
    }

    function Email_Register_BodyNonHtml()
    {
        return "Gracias por registrarte en nuestra plataforma. Pulsa el siguiente enlace para validar tu E-mail: ";
    }
?>