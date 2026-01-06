<?php
global $link;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include ('../layouts/config.php');

$mail = new PHPMailer(true);

// Consulta para obtener todos los correos electrónicos de la tabla "users"
$result = $link->query("SELECT useremail FROM users");

$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->SMTPSecure = $smtp_secure;
$mail->Port = $smtp_port;

// Recorre cada fila de la consulta
while ($row = $result->fetch_assoc()) {
    $email = $row['useremail'];

    // Agrega todas las direcciones de correo electrónico como destinatarios
    $mail->addBCC($email);
}


try {

    // Recipientes
    $mail->setFrom($smtp_from_email, $smtp_from_name);
    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Recordatorio de Pago de Cuotas Logiales';
    $mail->Body    = utf8_decode('
        Estimados QQ:.HH:.,<br>
        <br>
        Junto con saludarles fraternalmente, nos dirigimos a ustedes para recordarles la importancia de mantener al día el pago de sus cuotas logiales.<br>
        <br>
        Como es de su conocimiento, el compromiso de cada uno de nosotros es vital para el correcto sostenimiento de nuestro Taller, permitiéndonos cumplir con nuestras actividades, proyectos y obligaciones institucionales ante la Gran Logia.<br>
        <br>
        Les invitamos a regularizar su situación financiera a la brevedad posible. En caso de presentar alguna dificultad o tener dudas sobre sus saldos, les solicitamos ponerse en contacto directo con la Tesorería para buscar, en conjunto, la mejor solución.<br>
        <br>
        Agradecemos de antemano su fraternidad y compromiso constante con nuestra querida Logia.<br>
        <br>
        Reciban un fuerte y fraternal abrazo.<br>
        <br>
        <b>Tesorería R:. L:. Caleuche 250</b><br>
        Q:.H:. Tesorero. Pedro Jovino Bravo Crisostomo<br>
        Q:.H:. Tesorero Adjunto. Edgardo Ruotolo Cardozo<br>
        Email: edgardoruotolo@gmail.com<br>
        Tel: +56 9 6755 3841<br>
    ');

    $mail->send();
    //echo 'El mensaje ha sido enviado';
    header("Location: ../apps-tesoreria-entrada.php?msg=sent");
} catch (Exception $e) {
    //echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
    header("Location: ../apps-tesoreria-entrada.php?error=" . urlencode($mail->ErrorInfo));
}

// Liberar los resultados de la memoria
$result->free();

// Cerrar la conexión a la base de datos
$link->close();
?>