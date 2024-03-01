<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    // Verificar campos obligatorios y formato de correo electrónico
    if (empty($nombre) || empty($email) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Mostrar mensaje de error y detener el script
        echo "Por favor complete todos los campos correctamente.";
        exit;
    }

    // Limpiar los datos del usuario para evitar inyección de cabeceras
    $nombre = htmlspecialchars($nombre);
    $email = htmlspecialchars($email);
    $mensaje = htmlspecialchars($mensaje);

    $destinatario = "proyectos@seymtecsas.com"; // Cambia esto por tu dirección de correo electrónico
    $asunto = "Nuevo mensaje de contacto de $nombre";
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo electrónico: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje";

    // Envía el correo electrónico y verifica si se envió correctamente
    if (mail($destinatario, $asunto, $contenido)) {
        // Redirige al usuario a una página de confirmación
        header("Location: confirmacion.html");
        exit;
    } else {
        // Muestra un mensaje de error si el correo no se pudo enviar
        echo "Hubo un error al enviar el mensaje. Por favor, inténtelo de nuevo más tarde.";
    }
}
?>
