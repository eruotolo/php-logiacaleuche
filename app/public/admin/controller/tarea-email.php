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
        Estimados Q:.H:.,<br>
        <br>
        Espero que se encuentre bien y con ánimo en sus trabajos masónicos.<br>
        <br>
        Nos dirigimos a usted para recordarle la importancia de mantenerse al día con las cuotas de la Logia. Como saben, el compromiso de cada uno de nosotros con la Logia es fundamental para el sostenimiento y funcionamiento adecuado de nuestras actividades y proyectos.<br>
        <br>
        La cuota mensual es vital para asegurar que nuestra Logia pueda cumplir con sus responsabilidades financieras, incluyendo las contribuciones a la Gran Logia que son esenciales para el mantenimiento y prosperidad de nuestra institución a nivel superior.<br>
        <br>
        Si por alguna razón tienen pendiente alguna cuota, les invitamos a que procedan a regularizar su situación a la mayor brevedad posible. Esto nos permitirá continuar con nuestra labor de manera efectiva y sin contratiempos.<br>
        <br>
        Entendemos que pueden surgir circunstancias que dificulten el pago puntual, por lo que les pedimos que, en caso de tener algún problema, se acerquen a al Tesorero para buscar una solución adecuada.<br>
        <br>
        Agradecemos de antemano su comprensión y colaboración en este asunto tan importante para todos nosotros. Juntos podemos asegurar el éxito y el crecimiento de nuestra querida Logia.<br>
        <br>
        Cualquier consulta o aclaración, no duden en comunicarse con mi persona.<br>
        <br>
        Fraternalmente,
        <br>
        Tesorería R:. L:. Caleuche 250<br>
        Q:.H:. Tesorero. Edgardo Ruotolo Cardozo<br>
        Email: edgardoruotolo@gmail.com<br>
        Tel: +56 9 6755 3841<br>
       
    ');

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
}

// Liberar los resultados de la memoria
$result->free();

// Cerrar la conexión a la base de datos
$link->close();
?>