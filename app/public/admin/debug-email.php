<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'layouts/config.php';

echo "Probando conexi\u00f3n SMTP...\n";
echo "Host: " . $smtp_host . "\n";
echo "Port: " . $smtp_port . "\n";
echo "Username: " . $smtp_username . "\n";
// No mostramos password por seguridad

$mail = new PHPMailer(true);

try {
    // Configuraci\u00f3n del servidor con DEBUG activado
    $mail->SMTPDebug = SMTP::DEBUG_CONNECTION; // Muestra toda la conversaci\u00f3n SMTP
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Port       = $smtp_port;

    // Recipientes
    $mail->setFrom($smtp_from_email, 'Test Debug');
    $mail->addAddress($smtp_username); // Se env\u00eda a s\u00ed mismo para probar

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Prueba de Conexi\u00f3n SMTP';
    $mail->Body    = 'Si lees esto, la configuraci\u00f3n es correcta.';

    $mail->send();
    echo "\n\u00a1Mensaje enviado correctamente!\n";
} catch (Exception $e) {
    echo "\nEl mensaje no pudo ser enviado.\n";
    echo "Mailer Error: {$mail->ErrorInfo}\n";
}

