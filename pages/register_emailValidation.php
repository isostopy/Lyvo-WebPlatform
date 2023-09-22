<?php

   // Funcionalidades comunes.
   require_once '../includes/functions.php';

   if (isset($_GET['user'])) 
   {
        $userId = $_GET['user'];

        try
        {
            UserValidate($userId);
        }
        catch (Exception $e)
        {
            $error = $e->getMessage();
        }
   }
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lyvo Register</title>
   <link rel="icon" type="image/x-icon" href="../assets/icono.ico"/>
   <link rel="stylesheet" href="../assets/css/lyvo_style.css">
   <link rel="stylesheet" href="../assets/css/login_form.css">

</head>

<body>
    <div class="main-container">

        <div id="lyvo-logo">
            <img src="../assets/images/t_logo_lyvo_dark_256.png" alt="Lyvo">
        </div>

        <div id="left-panel">

            <div id="hoja-livo"></div>

            <div class="content">

                <h1>Crear cuenta</h1>

                <?php

                    // Mensajes.
                    require_once '../includes/messages.php';
                
                    if (isset($error)) 
                    {
                        echo '<span class="msg msg-error">'.$error.'</span>';
                    }
                    else
                    {
                        echo '<span class="msg msg-confirm">'.Message_Ok_Validation().'</span>';
                    }
                ?>

                <p>Puede cerrar esta ventana o volver al <a href="../public/login_form.php">LOGIN</a></p>

               </form>

            </div>

        </div>

        <div id="right-panel"></div>

        <div id="hoja-livo-grande"></div>

        <!-- FOOTER -->
        <?php include_once "../utils/htmlFooter.php"; ?>

    </div>


</body>

</html>