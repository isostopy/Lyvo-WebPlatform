<?php

    //"C:/xampp/htdocs/Lyvo-Pre"

    function print_directory_structure($path, $indent = 0) {
        $dir = new DirectoryIterator($path);
        $output = '';
    
        foreach ($dir as $file) {
            if ($file->isDot()) continue;
            
            $prefix = $file->isDir() ? '+ [DIR] ' : '-- [FILE] ';
            
            $output .= str_repeat("|   ", $indent) . $prefix . $file->getFilename();
    
            if ($file->isDir() && count(scandir($file->getPathname())) > 2) {
                $output .= "/";
            }
            
            $output .= "\n";
    
            if ($file->isDir()) {
                $output .= print_directory_structure($file->getPathname(), $indent + 1);
                $output .= "\n";
            }
        }
    
        return $output;
    }
    
    // Imprimir la estructura de directorios con saltos de línea convertidos a <br>
    echo nl2br(print_directory_structure("C:/xampp/htdocs/Lyvo-Pre"));
    ?>