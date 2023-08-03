<?php

   // Funcionalidades comunes.
   require '../includes/functions.php';

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
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>register form</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="../assets/css/style.css">

   </head>
   <body>
      
      <div class="form-container">

         
         <?php
            if (isset($error)) 
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
            else
            {
               echo '<span class="confirm-msg">Validación completa</span>';
            }
         ?>

         <form action="" method="post">

            <p><a href="../public/login_form.php">login</a></p>

         </form>

      </div>

   </body>
</html>