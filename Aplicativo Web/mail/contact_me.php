<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$name = sanitizeInput($_POST['name']);
$mail = filter_var(sanitizeInput($_POST['mail']), FILTER_VALIDATE_EMAIL);
$phone = sanitizeInput($_POST['phone']);
$message = sanitizeInput($_POST['message']);

if ($mail) {
    $header = 'From: ' . $mail . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";

    $fullMessage = "Este mensaje fue enviado por: " . $name . " \r\n";
    $fullMessage .= "Su e-mail es: " . $mail . " \r\n";
    $fullMessage .= "Teléfono de contacto: " . $phone . " \r\n";
    $fullMessage .= "Mensaje: " . $message . " \r\n";
    $fullMessage .= "Enviado el: " . date('d/m/Y', time());

    $para = 'daaviles3@espe.edu.ec';
    $asunto = 'Mensaje de... (Escribe como quieres que se vea el remitente de tu correo)';

    if (mail($para, $asunto, utf8_decode($fullMessage), $header)) {
        header("Location: index.html");
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Email no válido.";
}
?>
