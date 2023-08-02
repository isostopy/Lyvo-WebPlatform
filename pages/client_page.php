<?php

   // Datos.
   require '../includes/config.php';
   // Funcionalidades comunes.
   require '../includes/functions.php';
   
   // Comprobar que el usuario tiene sesión iniciada.
   UserCheckSession($GLOBALS['Role_Client']);

   // Enviar al usuario a la selección de avatar.
   LoadPage("public/avatar.php");

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>cliente</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="../assets/css/style.css">

   </head>
   <body>
      
   <div class="container">

      <div class="content">
         <h3>hi, <span>user</span></h3>
         <h1>welcome <span><?php echo $_SESSION['userData']->data->first_name ?></span></h1>
         <p>this is an user page</p>
         <a href="logout.php" class="btn">logout</a>
      </div>

   </div>

   </body>
</html>