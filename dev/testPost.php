<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["saludar"])) {
        // Acción cuando se presiona el botón "Saludar"
        $mensaje = "¡Hola, " . htmlspecialchars($_POST["nombre"]) . "!";
    } elseif (isset($_POST["despedir"])) {
        // Acción cuando se presiona el botón "Despedir"
        $mensaje = "¡Hasta luego, " . htmlspecialchars($_POST["nombre"]) . "!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP con 2 Botones</title>
</head>
<body>

    <h2>Formulario PHP con 2 Botones</h2>

    <?php
    // Mostrar el mensaje si existe
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <input type="submit" name="saludar" value="Saludar">
        <input type="submit" name="despedir" value="Despedir">
    </form>

</body>
</html>