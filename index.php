<?php
// Verificar si se está enviando el mensaje
$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el mensaje no está vacío
    if (!empty($_POST['mensaje'])) {
        $mensaje = htmlspecialchars($_POST['mensaje']);
        // Guardar en el archivo
        file_put_contents('mensajería/mensaje.txt', $mensaje);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería</title>
</head>
<body>
    <h1>Mensajería</h1>
    <form action="" method="POST">
        <label for="mensaje">Escribe tu mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50"><?php echo $mensaje; ?></textarea><br>
        <button type="submit">Enviar Mensaje</button>
    </form>
</body>
</html>