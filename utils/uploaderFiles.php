<?php

    // Datos.
    require_once '../includes/config.php';
    // Funcionalidades comunes.
    require_once '../includes/messages.php';

    function GetRoute($value)
    {
        switch ($value)
        {
            case Places::AUDITORIO->value: return "../3d-custom/room-auditorio/";
            case Places::EXPOSICIONES->value: return "../3d-custom/room-exposiciones/";
            case Places::SALAPRIVADA->value: return "../3d-custom/room-salaprivada/";

            default: throw new Exception(Message_Error_General());
        }
    }

    $target_dir = "";
    $message = "";

    // Comprobar que se están subiendo archivos
    if (count($_FILES) == 0) 
    {
        echo Info_UploadNoFile();
        exit;
    }

    // Subir archivos
    foreach ($_FILES as $input_name => $fileArray) 
    {
        try
        {
            // Comprobar el directorio de destino.
            if(isset($_POST['reference'])) 
            {
                $target_dir = GetRoute($_POST['reference']);
            } 
            else 
            {
                echo "Directorio de destino no especificado.";
                exit;
            }

            // Comprobar que se ha subido el archivo.
            if ($fileArray["name"] == "") 
            {
                // Componer mensaje de información.
                $message .= Info_UploadNoFile()."<br>";
                continue;
            }

            // Usando el nombre del input para renombrar el archivo
            $newFileName = $input_name . "." . strtolower(pathinfo($fileArray["name"], PATHINFO_EXTENSION));

            $target_file = $target_dir . basename($newFileName);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Comprobar tamaño
            if ($fileArray["size"] > 500000) 
            {
                // Componer mensaje de información.
                $message .= Info_UploadSizeMax()." ".$fileArray["name"]."<br>";
                continue;
            }

            // Comprobar formato
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") 
            {
                // Componer mensaje de información.
                $message .= Info_UploadFormatInvalid()." ".$fileArray["name"]."<br>";
                continue;
            }

            // Subir archivos
            if (move_uploaded_file($fileArray["tmp_name"], $target_file)) 
            {
                // Componer mensaje de información.
                $message .= Info_UploadFile()." ".basename($newFileName)."<br>";
            } 
            else 
            {
                // Componer mensaje de información.
                $message .= Info_UploadFileError()." ".$fileArray["name"].".<br>";
            }
        }
        catch(Exception $e)
        {
            throw new Exception(Message_Error_General());
        }
    }

    // Retornar información.
    echo $message;
    
?>