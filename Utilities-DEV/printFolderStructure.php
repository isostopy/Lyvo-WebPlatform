<?php

function listar_directorios_ruta($ruta) {
   // Abre un gestor de directorios para la ruta indicada
   $gestor_dir = opendir($ruta);

   echo "Directorio: " . $ruta;
   echo "<ul>";

   // Recorre todos los elementos del directorio
   while (false !== ($nombre_fichero = readdir($gestor_dir))) {
      $ruta_completa = $ruta . "/" . $nombre_fichero;

      // Si es un directorio se recorre recursivamente
      if (is_dir($ruta_completa) && $nombre_fichero!="." && $nombre_fichero!=".." && $nombre_fichero!="vendor") {
         listar_directorios_ruta($ruta_completa);
      } else if(pathinfo($ruta_completa, PATHINFO_EXTENSION) == "php") {
         echo "<li>";
         echo $nombre_fichero.": ";
         echo "<br/>";
         mostrar_contenido($ruta_completa);
         echo "</li>";
      }
   }
   echo "</ul>";
}

function mostrar_contenido($ruta_completa) {
   $contenido = file_get_contents($ruta_completa);
   echo "<pre>".htmlspecialchars($contenido)."</pre>";
}

// Aquí necesitarás proporcionar la ruta de tu directorio
listar_directorios_ruta("C:/xampp/htdocs/Lyvo-WebPlatform");

?>